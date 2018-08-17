import React from 'react'
import PropTypes from 'prop-types'
import { Field, reduxForm } from 'redux-form'
import { connect } from 'react-redux'

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
        <small id="emailHelp" className="form-text text-muted">By checking this option all of your toon in this squad will be shown in guild squad. By default only power of 5 strongest characters will count</small>
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

SquadForm = connect(
  (state, props) => ({
    initialValues: {
      name: props.data.name,
      full_squad: props.data.full_squad,
    },
  }),
)(SquadForm)


export default SquadForm
