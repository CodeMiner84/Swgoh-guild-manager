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
    <div>
      <hr/>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="YFN6J65X8T74W" />
        <input type="image" src="https://www.paypalobjects.com/en_US/PL/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
        <img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1" />
      </form>
    </div>
  </Navbar>
)

export default NavbarMenu
