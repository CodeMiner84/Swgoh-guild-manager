import React from 'react'
import PropTypes from 'prop-types'
import { createSelector } from 'reselect'
import { connect } from 'react-redux'
import Form from './Form'
import actions from '../../actions/user'
import actionsAccount from '../../actions/account'
import {confirmAlert} from "react-confirm-alert";

class Dashboard extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
      loaded: false,
    }
  }

  componentDidMount() {
    this.props.getAccount().then(() => {
      this.setState({
        loaded: true,
      })
    })
  }

  handleSubmit = (event) => {
    const params = {
      guildId: event.guild_id,
      guildCode: event.guild_code,
      uuid: event.uuid,
    }

    this.props.updateAccount(params).then(() => {
      this.setState({
        saved: true,
      })
    })
  }

  syncData = () => {
    this.props.syncAccount().then(response => {
      if (response.payload.code === 200) {
        this.syncAlert(true)
      } else {
        this.syncAlert(false)
      }
    }, this)
  }

  syncAlert = (success) => {
    confirmAlert({
      message: success ? 'Your characters will be fetched' : 'Your request is added to queue. Please wait',
      cancelLabel: 'OK',
    })
  }

  render() {
    if (this.props.auth.length === 0) {
      return (<div />)
    }

    return (
      <div >
        <div className="row">
          <div className="col">
            <h3 className={'pull-left'}>Account</h3>
            {this.props.auth != null && this.props.auth.uuid &&
            <button className={'btn btn-danger pull-right'} onClick={this.syncData}>Synchronize
              data</button>
            }
          </div>
        </div>
        {this.state.loaded &&
        <Form
          saved={this.state.saved}
          onSubmit={this.handleSubmit}
          submitting={this.state.submitting}
          data={this.props.auth}
        />
        }
      </div>
    )
  }
}

const getAccountAuth = state => state.account.auth

const selector = createSelector(
  getAccountAuth,
  auth => auth,
)

function mapStateToProps(state) {
  return {
    auth: selector(state),
  }
}

const mapDispatchToProps = {
  updateAccount: actions.updateAccount,
  syncAccount: actions.synchronizeAccount,
  getAccount: actionsAccount.getAccount,
}

Dashboard.defaultProps = {
  auth: false,
  updateAccount: () => {},
}

Dashboard.propTypes = {
  updateAccount: PropTypes.func,
  auth: PropTypes.shape(),
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)

