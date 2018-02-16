import React from 'react'
import PropTypes from 'prop-types'
import { createSelector } from 'reselect'
import { connect } from 'react-redux'
import Form from './Form'
import actions from '../../actions/user'

class Dashboard extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
    }
  }

  handleSubmit = (event) => {
    const params = {
      guildId: event.guildId,
      guildCode: event.guildCode,
      uuid: event.uuid,
    }

    this.props.updateAccount(params).then(() => {
      this.setState({
        saved: true,
      })
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
          saved={this.state.saved}
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

Dashboard.defaultProps = {
  auth: false,
}

Dashboard.propTypes = {
  updateAccount: PropTypes.func.isRequired,
  auth: PropTypes.shape(),
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)

