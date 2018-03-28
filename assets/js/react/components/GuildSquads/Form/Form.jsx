import React from 'react'
import PropTypes from 'prop-types'
import { Field, reduxForm } from 'redux-form'

let SquadForm = (props) => {
  const { handleSubmit, pristine, submitting, saved } = props
  return (
    <form onSubmit={handleSubmit}>
      {saved &&
      <div className={'alert alert-success'}>
        Squad has been sucessfully added.
      </div>
      }
      <div className={'form-group'}>
        <label htmlFor={'name'}>Squad name</label>
        <Field
          id={'name'}
          name={'name'}
          component={'input'}
          type={'text'}
          placeholder={'Squad name'}
          className={'form-control'}
        />
      </div>
      <div className={'form-group checkbox-group'}>
        <label htmlFor={'name'}>Full squad</label>
        <Field
          name={'full_squad'}
          component={'input'}
          type={'checkbox'}
          placeholder={'Full Squad'}
          className={'checkbox'}
        />
      </div>
      <div>
        <button type={'submit'} disabled={pristine || submitting} className={'btn btn-primary btn-sm'}>Save</button>
      </div>
    </form>
  )
}

SquadForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  pristine: PropTypes.bool.isRequired,
  submitting: PropTypes.bool.isRequired,
  saved: PropTypes.bool.isRequired,
}

SquadForm = reduxForm({
  form: 'SquadForm',
})(SquadForm)

export default SquadForm
