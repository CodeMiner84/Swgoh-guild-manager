import React from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { Field, reduxForm } from 'redux-form'

let AccountForm = (props) => {
  const { handleSubmit, pristine, submitting, saved } = props
  return (
    <form onSubmit={handleSubmit}>
      {saved &&
        <div className={'alert alert-success'}>
          Form has been sucessfully updated.
        </div>
      }
      <div className="form-group">
        <label>First Name</label>
        <Field
          name="favGuild"
          component="input"
          type="text"
          placeholder="Your guild"
          className="form-control"
        />
      </div>
      <div className="form-group">
        <label>Your swgoh code</label>
        <Field
          name="uuid"
          component="input"
          type="text"
          placeholder="Your uuid"
          className="form-control"
        />
        <small id="emailHelp" className="form-text text-muted">User code is required for some features in site.</small>
      </div>
      <div>
        <button type="submit" disabled={pristine || submitting} className="btn btn-primary">Submit</button>
      </div>
    </form>
  )
}

AccountForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  pristine: PropTypes.bool.isRequired,
  submitting: PropTypes.bool.isRequired,
  saved: PropTypes.bool.isRequired,
}

AccountForm = reduxForm({
  form: 'accountForm',
})(AccountForm)

AccountForm = connect(
  state => ({
    initialValues: state.account.auth,
  }),
)(AccountForm)

export default AccountForm
