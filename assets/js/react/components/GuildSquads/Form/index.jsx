import React from 'react'
import Form from './Form'
import { connect } from 'react-redux'
import PropTypes from 'prop-types'
import { createSelector } from 'reselect'
import actions from '../../../actions/guild_squads'

class BuildForm extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
    }
  }

  handleSubmit = (event) => {
    const params = {
      name: event.name,
      account: {
        id: this.props.auth.id,
      },
    }

    this.props.createSquad(params).then(() => {
      this.setState({
        saved: true,
      })
    })
  }

  render() {
    return (
      <div className={'mt-4'}>
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

const getAccount = state => state.guild_squads.squads

const selector = createSelector(
  getAccount,
  squads => squads,
)

function mapStateToProps(state) {
  return {
    squads: selector(state),
    auth: state.account.auth,
  }
}

const mapDispatchToProps = {
  createSquad: actions.create,
}

BuildForm.propTypes = {
  createSquad: PropTypes.func.isRequired,
}

export default connect(mapStateToProps, mapDispatchToProps)(BuildForm)

