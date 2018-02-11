import React from 'react'
import PropTypes from 'prop-types'
import { history as historyPropTypes } from 'history-prop-types'
import { Route, withRouter, matchPath } from 'react-router-dom'
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
import Collection from '../Collection'

class Main extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      phrase: '',
      auth: isAuth(),
      authUser: isAuth(),
    }
  }

  componentWillMount() {
    const shouldUserCheck = () => !matchPath(this.props.history.location.pathname, {
      path: '/(login|logout)',
    })
    if (shouldUserCheck()) {
      this.props.getAccount()
        .then((respond) => {
        }).catch((errors) => {
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
    logout()
    this.setState({
      auth: false,
    })
    this.props.history.push('/login')
  }

  toggleFiltering = () => matchPath(this.props.history.location.pathname, {
    path: '/(characters|guilds)',
  })

  render() {
    const allow = this.toggleFiltering()

    return (
      <div>
        <Topnav
          handleFiltering={this.handleFiltering}
          logoutUser={this.logoutUser}
          filtering={allow !== null && allow.isExact}
        />
        <div className="container-fluid">
          <div className="row">
            {this.state.auth &&
              <Navbar />
            }
            <main role="main" className="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
              <Route exact path="/" component={Dashboard} />
              <AuthorizedRoute path="/guilds" component={Guild} />
              <AuthorizedRoute path="/users/:code" component={Users} />
              <AuthorizedRoute path="/user/:code" component={User} />
              <AuthorizedRoute path="/characters" searchPhrase={this.state.phrase} component={Character} />
              <AuthorizedRoute path="/cart" component={Cart} />
              <AuthorizedRoute path="/account" component={Account} />
              <AuthorizedRoute path="/collection" component={Collection} />
              <Route path="/login" component={Login} />
            </main>
          </div>
        </div>
      </div>
    )
  }
}

Main.propTypes = {
  history: PropTypes.shape(historyPropTypes).isRequired,
}

const mapStateToProps = state => ({
  user: state.user.authUser,
})

const mapDispatchToProps = {
  getAccount: actions.getAccount,
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Main))
