import React from 'react'
import PropTypes from 'prop-types'
import { history as historyPropTypes } from 'history-prop-types'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import Form from './Form'
import actions from '../../../actions/guild_squads'

class BuildForm extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
      squad: {},
    }
  }

  componentDidMount() {
    this.getSquad()
  }

  getSquad() {
    const currentId = this.props.match.params.id

    let squad = {}
    this.props.guild_squads.filter(item => (parseInt(item.id, 10) === parseInt(currentId, 10) ? squad = item : false))

    this.setState({
      squad,
    })
  }

  handleSubmit = (event) => {
    const params = {
      name: event.name,
      fullSquad: event.full_squad,
    }

    this.props.updateSquad(this.state.squad.id, params).then(() => {
      this.setState({
        saved: true,
      })
    })
  }

  render() {
    if (this.props.guild_squads.length === 0) {
      this.props.history.push('/guild-squads')
    }

    if (!this.state.squad.name) {
      return <div />
    }

    return (
      <div className={'mt-4'}>
        <Form
          saved={this.state.saved}
          onSubmit={this.handleSubmit}
          submitting={this.state.submitting}
          data={this.state.squad}
        />
      </div>
    )
  }

}

function mapStateToProps(state) {
  return {
    guild_squads: state.guild_squads.guild_squads,
    auth: state.account.auth,
  }
}

const mapDispatchToProps = {
  updateSquad: actions.update,
}

BuildForm.propTypes = {
  updateSquad: PropTypes.func.isRequired,
}

BuildForm.defaultProps = {
  match: [],
}

BuildForm.propTypes = {
  history: PropTypes.shape(historyPropTypes).isRequired,
  guild_squads: PropTypes.shape.isRequired,
  match: PropTypes.shape(),
}

export default connect(mapStateToProps, mapDispatchToProps)(BuildForm)

