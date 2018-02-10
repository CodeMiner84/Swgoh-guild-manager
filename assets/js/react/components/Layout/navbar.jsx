import React from 'react';
import { Link } from 'react-router';
import FontAwesome from 'react-fontawesome';

const Navbar = () => (
  <nav className="col-md-2 d-none d-md-block bg-light sidebar">
    <div className="sidebar-sticky">
      <ul className="nav flex-column">
        <li className="nav-item">
          <Link to={'/'} className="nav-link">
            <FontAwesome name="home" className="mr-1" />
            Dashboard
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/account'} className="nav-link">
            <FontAwesome name="user" className="mr-1" />
            Account
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/guilds'} className="nav-link">
            <FontAwesome name="building" className="mr-1" />
            Guilds
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/users'} className="nav-link">
            <FontAwesome name="search" className="mr-1" />
              Search
            </Link>
        </li>
        <li className="nav-item">
          <Link to={'/characters'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
              Characters
            </Link>
        </li>
      </ul>
    </div>
  </nav>
);


export default Navbar;
