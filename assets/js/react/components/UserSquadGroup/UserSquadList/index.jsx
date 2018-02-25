import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import ReactTimeout from 'react-timeout'
import actions from '../../../actions/user_squad_group'
import Loader from '../../Loader'
import ListItem from './ListItem'

class UserSquadList extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      removed: false,
    }

    props.getAll()
      .catch(error => console.log('error', error))
  }

  removeSquad = (id) => {
    this.props.remove(id).then(() => {
      this.setState({removed: true})
      console.log('propsss', this.props);
      this.props.setTimeout(() => this.setState({removed: false}), 4000)
    }, this)
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }
    if (!this.props.user_squad_groups)
    {
      return (
        <div className={'alert alert-warning'}>You don't have squad yet. Craete one&nbsp;
          <Link className={'btn btn-primary btn-sm'} to={'/user-squad-group/add'}>HERE</Link>
        </div>
      )
    }

    return (
      <div className={'list-group'}>
        {this.props.user_squad_groups.map((item) => <ListItem removeSquad={this.removeSquad} item={item} />)}
      </div>
    )
  }
}

const mapStateToProps = state => ({
  user_squad_groups: state.user_squad_group.user_squad_groups,
  isLoading: state.user_squad_group.isLoading,
})

const mapDispatchToProps = {
  getAll: actions.fetch,
  remove: actions.removeSquadGroup,
}

UserSquadList.propTypes = {
  isLoading: PropTypes.bool.isRequired,
  remove: PropTypes.bool.isRequired,
};

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(UserSquadList));
