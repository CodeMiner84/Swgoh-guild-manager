import React from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import ReactTable from 'react-table'
import actions from '../../actions/guild'
import squadActions from '../../actions/guild_squads'
import Loader from '../../components/Loader'
import gridColumns from '../Guild/gridColumns'


class Dashboard extends React.Component {
  constructor(props) {
    super(props)

    props.getSquads()
    if (props.user.guild_code !== undefined || props.user.guild_id !== undefined) {
      props.getUsers(props.user.guild_id, props.user.guild_code).then(() => {
        console.log('props', props)
      })
    }
  }

  render() {
    if (this.props.isLoading ) {
      return <Loader />
    }
    const account = this.props.user

    if (account.guild_code === undefined || account.guild_id === undefined) {
      return <div className="alert alert-danger">Please complete guild data in your account</div>
    }

    if (Object.keys(this.props.dataMapper).length == 0) {
      return (<div />)
    }

    return (
      <div>
        <ReactTable
          data={this.props.dataMapper}
          columns={gridColumns(this.props.squads)}
          defaultPageSize={50}
        />
      </div>
    )
  }
}

Dashboard.defaultProps = {
  disabledFiltering: false,
}

Dashboard.propTypes = {
  disabledFiltering: PropTypes.bool,
  getAll: PropTypes.func.isRequired,
}

const getUser = () => state => state.account.auth
const getUsers = () => state => state.guild.users
const getSquads = () => state => state.guild_squads.guild_squads

const selector = createSelector(
  [getUser(), getUsers(), getSquads()],
  (user, usersList, squads) => {
    let users = []
    if (usersList.length === 1) {
      users = usersList[0].users
    }
    const dataMapper = []
    users.map((userRow) => {
      const row = {}

      row.name = userRow.name

      squads.map((squad) => {
        const squadCharacters = []

        if (Object.keys(squad.guild_squad_collection).length > 0) {
          squad.guild_squad_collection.map((gsc) => {
            squadCharacters.push(gsc.character.id)
          })
        }

        if (Object.keys(squadCharacters).length > 0) {
          const coll = []
          userRow.user_characters.map((userCollection) => {
            squadCharacters.map((characterId) => userCollection.character.id === characterId ? coll.push(userCollection.power) : 0)
          })
          let value = coll.length > 0 ? coll.reduce((prev, curr) => Number(prev) + Number(curr)) : 0

          row[squad.id] = value
        }

      })
      dataMapper.push(row)
    })

    return {
      user, users, squads, dataMapper,
    }
  },
)

function mapStateToProps(state) {
  return selector(state)
}

const mapDispatchToProps = {
  getUsers: actions.fetchGuildUsers,
  getSquads: squadActions.getAll,
}

Dashboard.defaultProps = {
  user: {},
}

Dashboard.propTypes = {
  user: PropTypes.shape,
  getUsers: PropTypes.func.isRequired,
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)
