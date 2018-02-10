import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router';
import { isAuth, logout } from '../../utils/auth';

const TopNav = ({ handleFiltering, filtering }) => (
  <nav className="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a className="navbar-brand col-sm-3 col-md-2 mr-0">SWGOH<i>manager</i></a>
    {filtering &&
      <input
        className="form-control form-control-dark w-100" type="text" onChange={handleFiltering}
        placeholder="Search" aria-label="Search"
      />
      }
    <ul className="navbar-nav px-3">
      <li className="nav-item text-nowrap">
        {!isAuth() &&
        <Link to="/login">Log in</Link>
        }
        {isAuth() &&
        <Link to="#" onClick={() => logout()}>Logout</Link>
        }
      </li>
    </ul>
  </nav>
  );

TopNav.defaultProps = {
  filtering: false,
};

TopNav.propTypes = {
  handleFiltering: PropTypes.func.isRequired,
  filtering: PropTypes.bool,
};

export default TopNav;
