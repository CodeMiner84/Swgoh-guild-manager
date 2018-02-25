import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { Route, withRouter, matchPath, Switch } from 'react-router-dom'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import actions from '../../actions/user_squad_group'
import UserSquadList from './UserSquadList'
import AddUserSquadGroupForm from './AddUserSquadGroupForm'
import EditUserSquadGroupForm from './EditUserSquadGroupForm'

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
    return (
      <div>
        <div className={'row'}>
          <div className={'btn-group mb-3'}>
            <Link to={'/user-squad-group'} className={'btn btn-info btn-sm'}>View squads</Link>
            <Link to={'/user-squad-group/add'} className={'btn btn-info btn-sm'}>Add squad</Link>
          </div>
        </div>
        <Switch >
          <Route exact path="/user-squad-group" component={UserSquadList} />
          <Route exact path="/user-squad-group/add" component={AddUserSquadGroupForm} />
          <Route exact path="/user-squad-group/edit/:id" component={EditUserSquadGroupForm} />
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

