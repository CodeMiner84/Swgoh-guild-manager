import React from 'react';
import { connect } from 'react-redux';
import { getFormValues } from 'redux-form';
import Form from './Form';
import actions from "../../actions/user";

class Dashboard extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      submitting: false,
    };
  }

  handleSubmit = (event) => {

    const post = {
      favGuild: event.favGuild,
    };

    this.props.updateAccount(post);
  }

  render() {
    return (
      <div >
        <h3>Account</h3>
        <Form
          onSubmit={this.handleSubmit}
          submitting={this.state.submitting}
        />
      </div>
    );
  }
}
function mapStateToProps(state) {
  return {
    data: state.account,
  };
}

const mapDispatchToProps = {
  updateAccount: actions.updateAccount,
};

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard);

