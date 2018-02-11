import React from 'react'
import PropTypes from 'prop-types'
import { Route, Redirect } from 'react-router-dom'
import { isAuth } from '../utils/auth'

const AuthorizedRoute = ({ component: Component, searchPhrase: phrase, ...rest }) => {
  return (
    <Route
      {...rest}
      render={props => isAuth() ? (
        <Component phrase={phrase} {...props} />
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
  location: '',
}

AuthorizedRoute.propTypes = {
  location: PropTypes.string,
  component: PropTypes.node.isRequired,
  searchPhrase: PropTypes.string.isRequired,
}

export default AuthorizedRoute
