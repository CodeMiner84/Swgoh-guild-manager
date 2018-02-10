import React from 'react';
import PropTypes from 'prop-types';
import Navbar from './navbar';
import Topnav from './top-nav';
import { isAuth } from '../../utils/auth';

class Main extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      phrase: '',
      filtering: this.props.children.props.route.filtering !== undefined,
      auth: isAuth(),
    };
  }

  handleFiltering = (e) => {
    this.setState({
      phrase: e.target.value,
    });
  }

  render() {
    return (
      <div>
        <Topnav handleFiltering={this.handleFiltering} filtering={this.state.filtering} />
        <div className="container-fluid">
          <div className="row">
            <Navbar />
            <main role="main" className="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
              {React.cloneElement(this.props.children, this.state)}
            </main>
          </div>
        </div>
      </div>
    );
  }
}

Main.defaultProps = {
  children: {},
};

Main.propTypes = {
  children: PropTypes.node,
};

export default Main;
