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
      <div className={'form-group'}>
        <label htmlFor={'name'}>Squad type</label>
        <Field
          id={'type'}
          name={'type'}
          component={'select'}
          type={'select'}
          placeholder={'Squad type'}
          className={'form-control'}
        >
          <option value={0}>Both side</option>
          <option value={1}>Light side</option>
          <option value={2}>Dark side</option>
        </Field>
      </div>
      <div>
        <button type={'submit'} disabled={pristine || submitting} className={'btn btn-primary btn-sm'}>Submit</button>
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
      type: props.data.type,
    },
  }),
)(SquadForm)


export default SquadForm
