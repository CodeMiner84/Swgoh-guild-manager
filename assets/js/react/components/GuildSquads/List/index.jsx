import React from 'react'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import actions from '../../../actions/guild_squads'
import Loader from '../../Loader'
import ListItem from './ListItem';


class List extends React.Component {
  constructor(props) {
    super(props)

    props.getAll();
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    return (
      <div className={'container'}>
        <div className={'list-group'}>
          {this.props.guild_squads.map((item) => <ListItem item={item} />)}
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
}

export default connect(mapStateToProps, mapDispatchToProps)(List);
