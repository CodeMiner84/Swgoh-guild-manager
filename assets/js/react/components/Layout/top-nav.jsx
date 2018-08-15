import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { isAuth } from '../../utils/auth'


const TopNav = ({ handleFiltering, filtering, logoutUser }) => (
  <nav className="navbar main navbar-dark sticky-top bg-dark d-block flex-md-nowrap p-0">
    <a className="col-sm-3 col-md-2 pull-left mr-0 text-center" style={{ display: 'block' }}>
      <img src="/img/logo.png" className="img-fluid" style={{ maxWidth: '80%', marginTop: '10px'}} alt=""/>
    </a>
    <div className="pull-right">
        {!isAuth() &&
        <Link className={'top-nav-button'} to="/login">Log in</Link>
        }
        {isAuth() &&
        <Link to="#" className={'top-nav-button'} onClick={logoutUser}>Logout</Link>
        }
    </div>
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
