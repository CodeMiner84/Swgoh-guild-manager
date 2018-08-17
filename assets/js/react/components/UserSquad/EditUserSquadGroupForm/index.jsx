import React from 'react'
import PropTypes from 'prop-types'
import { history as historyPropTypes } from 'history-prop-types'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import Form from './Form'
import actions from '../../../actions/user_squad'

class EditForm extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      submitting: false,
      saved: false,
      squad: {},
    }

    this.groupId = this.props.match.params.groupId
  }

  componentDidMount() {
    this.getSquad()
  }

  getSquad() {
    const currentId = this.props.match.params.id

    let squad = {}
    this.props.user_squad.filter(item => (parseInt(item.id, 10) === parseInt(currentId, 10) ? squad = item : false))

    this.setState({
      squad,
    })
  }

  handleSubmit = (event) => {
    const params = {
      name: event.name,
      type: parseInt(event.type || 0, 10),
    }

    this.props.updateSquad(this.groupId, this.state.squad.id, params).then(() => {
      this.props.history.push(`/user-squad/${this.groupId}`)
    })
  }

  render() {
    if (this.props.user_squad.length === 0) {
      this.props.history.push('/user-squad-group')
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
    user_squad: state.user_squad.user_squad,
    auth: state.account.auth,
  }
}

const mapDispatchToProps = {
  updateSquad: actions.update,
}

EditForm.propTypes = {
  updateSquad: PropTypes.func.isRequired,
}

EditForm.defaultProps = {
  match: [],
}

EditForm.propTypes = {
  history: PropTypes.shape(historyPropTypes).isRequired,
  user_squad_group: PropTypes.shape().isRequired,
  match: PropTypes.shape(),
}

export default connect(mapStateToProps, mapDispatchToProps)(EditForm)

