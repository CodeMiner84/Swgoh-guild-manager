import React from 'react'
import { connect } from 'react-redux'
import PropTypes from 'prop-types'
import { createSelector } from 'reselect'
import actions from '../../../actions/user_squad'
import Form from './Form'

class BuildForm extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
    }

    this.groupId = this.props.match.params.groupId
  }

  handleSubmit = (event) => {
    const params = {
      name: event.name,
    }

    this.props.createSquadGroup(this.groupId, params).then(response => this.props.history.push(`/user-squad/${this.groupId}`))
  }

  render() {
    return (
      <div className={'mt-4'}>
        <Form
          saved={this.state.saved}
          onSubmit={this.handleSubmit}
          submitting={this.state.submitting}
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
  }
}

const mapDispatchToProps = {
  createSquadGroup: actions.create,
}

BuildForm.propTypes = {
  createSquadGroup: PropTypes.func.isRequired,
}

export default connect(mapStateToProps, mapDispatchToProps)(BuildForm)

