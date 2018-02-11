import React from 'react'
import { connect } from 'react-redux'
import { Field, reduxForm, formValueSelector } from 'redux-form'
import { createSelector } from 'reselect'

let AccountForm = (props) => {
  const { handleSubmit, pristine, reset, submitting } = props
  return (
    <form onSubmit={handleSubmit}>
      <div>
        <label>First Name</label>
        <div>
          <Field
            name="favGuild"
            component="input"
            type="text"
            placeholder="Your guild"
          />
        </div>
      </div>
      <div>
        <label>Your swgoh code</label>
        <div>
          <Field
            name="uuid"
            component="input"
            type="text"
            placeholder="Your uuid"
          />
        </div>
      </div>
      <div>
        <button type="submit" disabled={pristine || submitting}>Submit</button>
      </div>
    </form>
  )
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
