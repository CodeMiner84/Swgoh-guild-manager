import React from 'react'
import PropTypes from 'prop-types'
import ReactGA from 'react-ga'
import { history as historyPropTypes } from 'history-prop-types'
import { Route, withRouter, matchPath, Switch } from 'react-router-dom'
import { connect } from 'react-redux'
import AuthorizedRoute from '../../router/AuthorizedRoute'
import Navbar from './navbar'
import Topnav from './top-nav'
import { isAuth, logout } from '../../utils/auth'
import actions from '../../actions/account'
import Dashboard from '../Dashboard'
import User from '../User'
import Character from '../Characters'
import Account from '../Account'
import Login from '../Login'
import Users from '../Users'
import Cart from '../Cart'
import Guild from '../Guild'
import Register from '../Register'
import Guilds from '../Guilds'
import Collection from '../Collection'
import GuildSquads from '../GuildSquads'
import UserSquadGroup from '../UserSquadGroup'
import UserSquad from '../UserSquad'
import Mods from '../Mods'

class Main extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      phrase: '',
      auth: isAuth(),
      authUser: isAuth(),
    }
    ReactGA.initialize('UA-116511446-1')
    ReactGA.pageview(window.location.pathname)
  }

  componentWillMount() {
    const shouldUserCheck = () => !matchPath(this.props.history.location.pathname, {
      path: '/(login|logout|register)',
    })
    if (shouldUserCheck()) {
      this.props.getAccount()
        .then(() => {

        }).catch(() => {
          this.props.history.push('/login')
        })
    }
  }

  componentWillReceiveProps() {
    this.setState({
      auth: isAuth(),
    })
  }

  handleFiltering = (e) => {
    this.setState({
      phrase: e.target.value,
    })
  }

  logoutUser = () => {
    this.props.logoutUser()
    logout()
    this.setState({
      auth: false,
    })
    this.props.history.push('/login')
  }

  toggleFiltering = () => matchPath(this.props.history.location.pathname, {
    path: '/(characters|guilds|collection|)',
  })

  matchRoute = () => {
    const regex =  /guild-squads\/\d\/builder/g
    const str = this.props.history.location.pathname
    const match = str.match(regex)

    return match !== null && match.length > 0 ? true : false
  }

  render() {
    const allow = this.toggleFiltering()
    const showFiltering = (allow !== null && allow.isExact) || this.matchRoute(this.props.history.location.pathname)

    return (
      <div>
        <Topnav
          handleFiltering={this.handleFiltering}
          logoutUser={this.logoutUser}
          filtering={showFiltering}
        />
        <div className="container-fluid">
          <div className="row">
            {this.state.auth &&
              <Navbar />
            }
            <main role="main" className="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
              <Route exact path="/" component={Dashboard} />
              <Switch>
                <Route path="/login" component={Login} />
                <Route path="/register" component={Register} />
                <AuthorizedRoute path="/users/:code" component={Users} />
                <AuthorizedRoute path="/user/:code" component={User} />
                <AuthorizedRoute path="/guild" component={Guild} />
                <AuthorizedRoute path="/guilds" component={Guilds} />
                <AuthorizedRoute path="/characters" searchPhrase={this.state.phrase} component={Character} />
                <AuthorizedRoute path="/cart" component={Cart} />
                <AuthorizedRoute path="/account" noUuid component={Account} />
                <AuthorizedRoute path="/collection" searchPhrase={this.state.phrase} component={Collection} />
                <AuthorizedRoute path="/guild-squads" component={GuildSquads} />
                <AuthorizedRoute path="/user-squad-group" component={UserSquadGroup} />
                <AuthorizedRoute path="/user-squad/:groupId" component={UserSquad} />
                <AuthorizedRoute path="/mods" component={Mods} />
              </Switch>
            </main>
          </div>
        </div>
      </div>
    )
  }
}

Main.propTypes = {
  history: PropTypes.shape(historyPropTypes).isRequired,
  getAccount: PropTypes.func.isRequired,
}

const mapStateToProps = state => ({
  user: state.user.authUser,
})

const mapDispatchToProps = {
  getAccount: actions.getAccount,
  logoutUser: actions.logoutUser,
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Main))
