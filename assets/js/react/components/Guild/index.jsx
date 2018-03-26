import React from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { Link } from 'react-router-dom'
import { createSelector } from 'reselect'
import ReactTable from 'react-table'
import actions from '../../actions/guild'
import squadActions from '../../actions/guild_squads'
import Loader from '../../components/Loader'
import gridColumns from '../Guild/gridColumns'

function sortProperties(obj) {
  // convert object into array
  const sortable = []
  for (const key in obj) {
    if (obj.hasOwnProperty(key)) { sortable.push([key, obj[key]]) }
  } // each item is an array in format [key, value]

  // sort items by value
  sortable.sort((a, b) => {
    let x = a[1], y = b[1]
    return !(x < y ? -1 : x > y ? 1 : 0)
  })
  return sortable // array in format [ [ key1, val1 ], [ key2, val2 ], ... ]
}

class Dashboard extends React.Component {
  constructor(props) {
    super(props)

    props.getSquads()
    if (props.user.guild_code !== undefined || props.user.guild_id !== undefined) {
      props.getUsers(props.user.guild_id, props.user.guild_code)
    }
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }
    const account = this.props.user

    if (account.guild_code === undefined || account.guild_id === undefined) {
      return <div className="alert alert-danger">
        Please complete guild data in your account
        <Link className={'btn btn-primary btn-sm ml-2'} title={'Build squad'} to={'/account'}>HERE</Link>
      </div>
    }

    if (Object.keys(this.props.dataMapper).length == 0) {
      return (<div />)
    }


    if (!this.props.auth.uuid) {
      return (
        <div className="alert alert-danger">
          You need to map your user uuid <Link to={'/account'}>HERE</Link>
        </div>
      )
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
const getAccount = () => state => state.account.auth

const selector = createSelector(
  [getUser(), getUsers(), getSquads(), getAccount()],
  (user, usersList, squads, auth) => {
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
            squadCharacters.push(gsc.character)
          })
        }

        if (Object.keys(squadCharacters).length > 0) {
          const coll = []
          userRow.user_characters.map((userCollection) => {
            squadCharacters.map(characterItem => userCollection.character.id === characterItem.id ? coll.push(userCollection) : 0)
          })

          const squadChars = {}

          coll.map((character) => {
            squadChars[character.character.name] = character.power
          })

          if (squad.full_squad) {
            let value = 0
           coll.length > 0 ? coll.map(item => value = value + item.power) : 0

            const sortable = []
            for (const key in squadChars) {
              if (squadChars.hasOwnProperty(key)) { sortable.push([key, squadChars[key]]) }
            }

            row[squad.id] = {
              val: value,
              chars: sortable,
            }

          } else {
            let value = 0

            let bestCharacters = sortProperties(squadChars).slice(0, 5)
            bestCharacters.map(item => {
              if (item !== undefined) {
                value += Number(item[1])
              }
            })

            row[squad.id] = {
              val: value,
              chars: bestCharacters,
            }
          }
        }
      })
      dataMapper.push(row)
    })

    return {
      user, users, squads, dataMapper, auth
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
  getSquads: PropTypes.func.isRequired,
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)
