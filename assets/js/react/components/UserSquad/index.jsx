import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { Route, withRouter, matchPath, Switch } from 'react-router-dom'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import actions from '../../actions/user_squad'
import AddUserSquadGroupForm from './AddUserSquadGroupForm'
import EditUserSquadGroupForm from './EditUserSquadGroupForm'
import SquadsLists from './SquadsLists'

class GuildSquads extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
    }
  }

  handleSubmit = (event) => {
    const params = {
      favGuild: event.favGuild,
      uuid: event.uuid,
    }

    this.props.createSquad(params).then(() => {
      this.setState({
        saved: true,
      })
    })
  }

  render() {
    const groupId = this.props.match.params.groupId

    return (
      <div>
        <div className={'row'}>
          <div className={'btn-group mb-3'}>
            <Link to={'/user-squad-group'} className={'btn btn-info btn-sm'}>View groups</Link>
            <Link to={`/user-squad/${groupId}`} className={'btn btn-info btn-sm'}>View squads</Link>
            <Link to={`/user-squad/${groupId}/add`} className={'btn btn-info btn-sm'}>Add squad</Link>
          </div>
        </div>
        <Switch >
          <Route exact path={`/user-squad/:groupId`} groupId={groupId} component={SquadsLists} />
          <Route exact path={`/user-squad/:groupId/add`} groupId={groupId} component={AddUserSquadGroupForm} />
          <Route exact path={`/user-squad/:groupId/edit/:id`} groupId={groupId} component={EditUserSquadGroupForm} />
          {/*<Route exact path="/user-squad/:id/builder" component={props => <Builder phrase={this.props.phrase} {...props} />} />*/}
        </Switch>
      </div>
    )
  }
}

const getAccount = state => state.account.auth

const selector = createSelector(
  getAccount,
  auth => auth,
)

function mapStateToProps(state) {
  return {
    auth: selector(state),
  }
}

const mapDispatchToProps = {
  createSquad: actions.create,
}

GuildSquads.defaultProps = {
  auth: false,
  phrase: '',
}

GuildSquads.propTypes = {
  updateAccount: PropTypes.func.isRequired,
  auth: PropTypes.shape(),
  phrase: PropTypes.string,
}

export default connect(mapStateToProps, mapDispatchToProps)(GuildSquads)

