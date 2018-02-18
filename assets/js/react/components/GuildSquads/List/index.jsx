import React from 'react'
import { connect } from 'react-redux'
import ReactTimeout from 'react-timeout'
import actions from '../../../actions/guild_squads'
import Loader from '../../Loader'
import ListItem from './ListItem';


class List extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      removed: false,
    }

    props.getAll().then()
  }

  removeSquad = (id) => {
    this.props.removeSquad(id).then(() => {
      this.setState({removed: true})
      this.props.setTimeout(() => this.setState({removed: false}), 4000)
    }, this)
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    return (
      <div className={'container'}>
        {this.state.removed &&
        <div className={'alert alert-success'}>
          Squad has been successfully removed!
        </div>
        }
        <div className={'list-group'}>
          {this.props.guild_squads.map((item) => <ListItem removeSquad={this.removeSquad} item={item} />)}
        </div>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  guild_squads: state.guild_squads.guild_squads,
  isLoading: state.guild_squads.isLoading,
})

const mapDispatchToProps = {
  getAll: actions.getAll,
  removeSquad: actions.removeSquad,
}

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(List));
