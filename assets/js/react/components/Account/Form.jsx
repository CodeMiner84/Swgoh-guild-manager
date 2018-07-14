import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import { Field, reduxForm } from 'redux-form'

let AccountForm = (props) => {
  const { handleSubmit, pristine, submitting, saved } = props

  return (
    <form onSubmit={handleSubmit}>
      {saved &&
        <div className={'alert alert-success'}>
          Your data has beed saved.
        </div>
      }
      {/*<div className="form-group">*/}
        {/*<label>Guild Id</label>*/}
        {/*<Field*/}
          {/*name="guild_id"*/}
          {/*component="input"*/}
          {/*type="text"*/}
          {/*placeholder="Guild id"*/}
          {/*className="form-control"*/}
        {/*/>*/}
        {/*<small>Guild id can be get from https://swgoh.gg/g/GUILD_ID/GUILD_ALIAS/</small>*/}
      {/*</div>*/}
      {/*<div className="form-group">*/}
        {/*<label>Guild code</label>*/}
        {/*<Field*/}
          {/*name="guild_code"*/}
          {/*component="input"*/}
          {/*type="text"*/}
          {/*placeholder="Guild alias"*/}
          {/*className="form-control"*/}
        {/*/>*/}
        {/*<small>Guild code can be get from https://swgoh.gg/g/GUILD_ID/GUILD_ALIAS/</small>*/}
      {/*</div>*/}
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
        <small id="emailHelp" className="form-text text-muted">Save form and check if Your account is on <Link to={`http://swgoh.gg/u/${props.data.uuid}`} target={"_blank"}>http://swgoh.gg/u/{props.data.uuid}</Link></small>
      </div>
      <div>
        <button type="submit" disabled={pristine || submitting} className="btn btn-primary">Save</button>
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
