import React from 'react';
import Form from './Form';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import PropTypes from 'prop-types';
import actions from '../../actions/login';
import Main from '../Layout';
import { withRouter, browserHistory } from 'react-router';


class Login extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      username: '',
      password: '',
      submitted: false,
    };
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.setState({ submitted: true });
    this.props.login(this.state.username, this.state.password).then(() => browserHistory.push('/guilds'));
  }

  onChange = (e) => {
    const { name, value } = e.target;
    this.setState({ [name]: value });
  }

  render() {
    return (
      <div>
        {this.props.submitted &&
          <div>... LOADING</div>
        }
        <Form
          handleSubmit={this.handleSubmit}
          onChange={this.onChange}
        />
      </div>
    );
  }
}

function mapStateToProps(state) {
  return {
    user: state.login.user,
    submitted: state.login.submitted,
  };
}

const mapDispatchToProps = {
  login: actions.login,
};

Login.defaultProps = {
  afterLogin: () => {},
  submitted: false,
};

Login.propTypes = {
  afterLogin: PropTypes.func,
  submitted: PropTypes.bool,
};

Login.contextTypes = {
  router: PropTypes.object.isRequired,
};

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Login));
