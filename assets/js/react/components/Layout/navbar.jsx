import React from 'react'
import { Link } from 'react-router-dom'
import FontAwesome from 'react-fontawesome'

const Navbar = () => (
  <nav className="col-md-2 d-none d-md-block bg-light sidebar">
    <div className="sidebar-sticky">
      <h6 className="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>GENERAL</span>
        <a className="d-flex align-items-center text-muted" href="#">
          <span data-feather="plus-circle" />
        </a>
      </h6>
      <ul className="nav flex-column">
        <li className="nav-item">
          <Link to={'/'} className="nav-link">
            <FontAwesome name="home" className="mr-1" />
            Dashboard
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/characters'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            Characters
          </Link>
        </li>
        {/*<li className="nav-item">*/}
          {/*<Link to={'/guilds'} className="nav-link">*/}
            {/*<FontAwesome name="building" className="mr-1" />*/}
            {/*Guilds*/}
          {/*</Link>*/}
        {/*</li>*/}
      </ul>
      <h6 className="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>PERSONAL</span>
        <a className="d-flex align-items-center text-muted" href="#">
          <span data-feather="plus-circle" />
        </a>
      </h6>
      <ul className="nav flex-column">
        <li className="nav-item">
          <Link to={'/account'} className="nav-link">
            <FontAwesome name="user" className="mr-1" />
            Account
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/collection'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            Your collection
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/user-squad-group'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            User squads
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/guild-squads'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            Guild squads
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/guild'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            Your guild
          </Link>
        </li>
        <li className="nav-item">
          <Link to={'/mods'} className="nav-link">
            <FontAwesome name="bolt" className="mr-1" />
            Mods
          </Link>
        </li>
      </ul>
    </div>
  </nav>
)


export default Navbar
