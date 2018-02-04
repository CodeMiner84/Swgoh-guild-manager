import React from 'react';
import { Link } from 'react-router';

const Main = props => (
  <div>
    <div style={{ border: '#FF0000', color: '#000000', width: '100%', padding: '10px 30px' }} className="row">
      <nav className="navbar navbar-inverse">
        <div className="container-fluid">
          <ul className="nav navbar-nav">
            <li>
              <Link to="/">Guild</Link>
            </li>
            <li>
              <Link to="/search">User</Link>
            </li>
            <li>
              <Link to="/characters">Characters</Link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div style={{ border: '#FF0000', color: '#000000', width: '100%', padding: '10px 30px' }}>
      {props.children}
    </div>
  </div>
);

export default Main;
