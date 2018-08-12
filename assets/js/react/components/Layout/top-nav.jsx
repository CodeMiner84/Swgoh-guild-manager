import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { isAuth } from '../../utils/auth'


const TopNav = ({ handleFiltering, filtering, logoutUser }) => (
  <nav className="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a className="navbar-brand col-sm-3 col-md-2 mr-0 text-center" style={{ display: 'block' }}>
      <img src="/img/logo.png" className="img-fluid" style={{ maxWidth: '80%'}} alt=""/>
    </a>

    <ul className="navbar-nav px-3">
      <li className="nav-item text-nowrap">
        {!isAuth() &&
        <Link to="/login">Log in</Link>
        }
        {isAuth() &&
        <Link to="#" onClick={logoutUser}>Logout</Link>
        }
      </li>
    </ul>
  </nav>
  )

TopNav.defaultProps = {
  filtering: false,
}

TopNav.propTypes = {
  handleFiltering: PropTypes.func.isRequired,
  filtering: PropTypes.bool,
  logoutUser: PropTypes.func.isRequired,
}

export default TopNav
