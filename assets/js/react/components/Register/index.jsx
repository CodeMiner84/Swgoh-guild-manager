import React from 'react'
import { connect } from 'react-redux'
import { withRouter, Link } from 'react-router-dom'
import { createSelector } from 'reselect'
import PropTypes from 'prop-types'
import actions from '../../actions/login'
import Form from './Form'
import Loader from '../Loader'

class Register extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      username: '',
      password: '',
      submitted: false,
    }

    this.validation = true
  }

  onChange = (e) => {
    const { name, value } = e.target
    this.setState({ [name]: value })
  }

  handleSubmit = (e) => {
    e.preventDefault()
    this.setState({ submitted: true })
    this.validation = true
    if (this.state.email === '' || this.state.username === '' || this.state.password === '') {
      this.validation = false
    }

    if (this.validation) {
      this.props.register(this.state.username, this.state.email, this.state.password).then(
        (respond) => {
          console.log('_____', this.props.registerResponse);
          if (this.props.registerResponse === null) {
            console.log('this.props.registerResponse', this.props.registerResponse);
            this.props.history.push('/')
          }
        },
      )
    }
  }

  render() {
    if (this.props.submitted) {
      return <Loader />
    }
    console.log('state.props', this.props)

    return (
      <div>
        <Form
          handleSubmit={this.handleSubmit}
          onChange={this.onChange}
          error={this.props.registerResponse && this.props.registerResponse.code || false}
          message={this.props.registerResponse && this.props.registerResponse.message || ''}
          submitted={this.props.submitted}
        />
      </div>
    )
  }
}

function mapStateToProps(state) {
  return {
    user: state.login ? state.login.user : null,
    error: state.login.error,
    login: state.login.login,
    registerResponse: state.login.message,
    submitted: state.login.submitted,
  }
}

const mapDispatchToProps = {
  register: actions.register,
}

Register.defaultProps = {
  afterRegister: () => {},
  register: () => {},
  error: false,
  submitted: false,
}

Register.propTypes = {
  afterRegister: PropTypes.func,
  register: PropTypes.func,
  error: PropTypes.bool,
  submitted: PropTypes.bool,
  logged: PropTypes.bool,
}

Register.contextTypes = {
  router: PropTypes.object.isRequired,
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Register))
