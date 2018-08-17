import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import ReactTimeout from 'react-timeout'
import actions from '../../../actions/user_squad'
import Loader from '../../Loader/index'
import ListItem from './ListItem'

class UserSquadList extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      removed: false,
    }

    props.getAll(this.props.match.params.groupId)
      .catch(error => console.log('error', error))
  }

  removeSquad = (id) => {
    this.props.remove(this.props.match.params.groupId, id).then(() => {
      this.setState({removed: true})
      this.props.setTimeout(() => this.setState({removed: false}), 4000)
    }, this)
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }
    const squads = this.props.user_squad
    if (squads.length === 0)
    {
      return (
        <div className={'alert alert-warning'}>You don't have squad yet. Craete one&nbsp;
          <Link className={'btn btn-primary btn-sm'} to={'/user-squad-group/add'}>HERE</Link>
        </div>
      )
    }

    return (
      <div className={'list-group'}>
        {squads.map((item) => <ListItem key={item.id} removeSquad={this.removeSquad} groupId={this.props.match.params.groupId} item={item} />)}
      </div>
    )
  }
}

const mapStateToProps = state => ({
  user_squad: state.user_squad.user_squad,
  isLoading: state.user_squad.isLoading,
})

const mapDispatchToProps = {
  getAll: actions.fetch,
  remove: actions.removeSquad,
}

UserSquadList.defaultProps = {
  match: [],
  remove: () => {},
};

UserSquadList.propTypes = {
  isLoading: PropTypes.bool.isRequired,
  remove: PropTypes.func,
  match: PropTypes.shape(),
};

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(UserSquadList));
