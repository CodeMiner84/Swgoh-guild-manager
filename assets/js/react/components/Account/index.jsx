import React from 'react'
import { connect } from 'react-redux'
import { getFormValues } from 'redux-form'
import Form from './Form'
import actions from '../../actions/user'
import { createSelector } from 'reselect'

class Dashboard extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
    }
  }

  handleSubmit = (event) => {
    const params = {
      favGuild: event.favGuild,
      uuid: event.uuid,
    }

    this.props.updateAccount(params).then(() => {
      console.log('updated');
      console.log(this.props.auth);
    })
  }

  render() {
    if (this.props.auth.length === 0) {
      return (<div />)
    }

    return (
      <div >
        <h3>Account</h3>
        <Form
          onSubmit={this.handleSubmit}
          submitting={this.state.submitting}
          data={this.props.auth}
        />
      </div>
    )
  }
}

const getAccount = state => state.account.auth

const selector = createSelector(
  getAccount,
  auth => auth,
)

function mapStateToProps(state) {
  return {
    auth: selector(state),
  }
}

const mapDispatchToProps = {
  updateAccount: actions.updateAccount,
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)

