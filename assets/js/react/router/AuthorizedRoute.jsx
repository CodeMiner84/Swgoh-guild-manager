import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { Route, Redirect, Link } from 'react-router-dom'
import { createSelector } from 'reselect'
import { connect } from 'react-redux'
import { isAuth } from '../utils/auth'
import accountActions from '../actions/account'

class AuthHOC extends Component {
  componentDidMount() {
    this.props.getAccount()
  }
  render() {
    const { component: Component, searchPhrase: phrase, ...rest } = this.props
    return (
      <Route
        {...rest}
        render={props => isAuth() ? (
          (
            rest.auth.uuid || rest.noUuid !== undefined ?
              <Component phrase={phrase} {...props} /> :
              <div className="alert alert-danger">
                You need to map your user uuid <Link to={'/account'}>HERE</Link>
              </div>
          )
        ) : (
          <Redirect
            to={{
              pathname: '/login',
              state: { from: props.location },
            }}
          />
        )}
      />
    )
  }
}

const AuthorizedRoute = ({ component: Component, searchPhrase: phrase, ...rest }) => {
  return (
    <Route
      {...rest}
      render={props => isAuth() ? (
        (
          rest.auth.uuid || rest.noUuid !== undefined ?
            <Component phrase={phrase} {...props} /> :
            <div className="alert alert-danger">
              You need to map your user uuid <Link to={'/account'}>HERE</Link>
            </div>
        )
      ) : (
        <Redirect
          to={{
            pathname: '/login',
            state: { from: props.location },
          }}
        />
      )}
    />
  )
}

AuthorizedRoute.defaultProps = {
  searchPhrase: '',
}

AuthorizedRoute.propTypes = {
  searchPhrase: PropTypes.string,
}

function mapStateToProps(state) {
  return {
    auth: state.account.auth,
  }
}

const mapDispatchToProps = {
  getAccount: accountActions.getAccount
}

export default connect(mapStateToProps, mapDispatchToProps)(AuthHOC)
