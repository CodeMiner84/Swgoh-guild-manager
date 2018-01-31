import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import actions from '../../actions/user';
import UsersList from './UsersList';

class Dashboard extends React.Component {
  constructor(props) {
    super(props);
    this.props.getAll();
  }

  render() {
    if (this.props.users.length === 0) {
      return (<div />);
    }

    return (
      <div >
        <UsersList users={this.props.users} />
      </div>
    );
  }
}

Dashboard.propTypes = {
  getAll: PropTypes.func.isRequired,
};

const getGuilds = state => state.user.users;

const selector = createSelector(
  getGuilds,
  users => users,
);

function mapStateToProps(state) {
  return {
    users: selector(state),
  };
}

const mapDispatchToProps = {
  getAll: actions.fetchUsers,
};

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard);
