import React from 'react'
import { Link } from 'react-router-dom'
import FontAwesome from 'react-fontawesome'
import {Navbar, Nav, NavItem, MenuItem} from 'react-bootstrap'

const NavbarMenu = () => (
  <Navbar className={'col-md-3 col-lg-2 d-md-block left-sidebar align-items-start'}>
    <Navbar.Header>
      <Navbar.Toggle />
    </Navbar.Header>
    <Navbar.Collapse>
      <Nav>
        <h4 className={'text-muted'}>GENERAL</h4>
        <NavItem eventKey={1} >
          <Link to={'/'} className="nav-link">
            <FontAwesome name="home" className="mr-1" />
            Dashboard
          </Link>
        </NavItem>
        <NavItem eventKey={2} >
          <Link to={'/characters'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            Characters
          </Link>
        </NavItem>
        <h4 className={'text-muted'}>PERSONAL</h4>
        <NavItem>
          <Link to={'/account'} className="nav-link">
            <FontAwesome name="user" className="mr-1" />
            Account
          </Link>
        </NavItem>
        <NavItem>
          <Link to={'/mods'} className="nav-link">
            <FontAwesome name="gears" className="mr-1" />
            Mods
          </Link>
        </NavItem>
        <NavItem>
          <Link to={'/collection'} className="nav-link">
            <FontAwesome name="users" className="mr-1" />
            Your collection
          </Link>
        </NavItem>
        <NavItem>
          <Link to={'/user-squad-group'} className="nav-link">
            <FontAwesome name="list-alt" className="mr-1" />
            User squads
          </Link>
        </NavItem>
      </Nav>
    </Navbar.Collapse>
  </Navbar>
)

export default NavbarMenu
