import React from 'react'
import PropTypes from 'prop-types'
import { Route, Redirect, Link } from 'react-router-dom'
import { createSelector } from 'reselect'
import { connect } from 'react-redux'
import { isAuth } from '../utils/auth'
import actions from '../actions/mods'
import ReactTimeout from 'react-timeout'

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


const getAccount = () => state => state.account.auth

const authSelector = createSelector(
  [getAccount()],
  auth => auth,
)

function mapStateToProps(state) {
  return {
    auth: authSelector(state),
  }
}

export default connect(mapStateToProps, null)(AuthorizedRoute)
