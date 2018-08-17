import React from 'react'
import FontAwesome from 'react-fontawesome'

const Form = ({ handleSubmit, onChange, error, message}) => {
  return (
    <div className={'d-flex justify-content-center'}>
      <div className={'border col-sm-6 px-5 pt-4 pb-3'}>
        {error &&
        <div className="alert alert-danger">
          {message}
        </div>
        }
        <form className="" onSubmit={handleSubmit}>
          <div className={'form-group row'}>
            <label htmlFor="username" className={'col-sm-2 col-form-label'}></label>
            <div className={'col-sm-10'}>
              <div className="text-muted"><FontAwesome name={'exclamation-circle'} /> Username and Email is no related to Your swgoh.gg account.</div>
            </div>
          </div>
          <div className={'form-group row'}>
            <label htmlFor="username" className={'col-sm-2 col-form-label'}>Username</label>
            <div className={'col-sm-10'}>
              <input type="text" className={'form-control'} onChange={(elem) => onChange(elem)} name="username" id="username" />
            </div>
          </div>
          <div className={'form-group row'}>
            <label htmlFor="email" className={'col-sm-2 col-form-label'}>E-mail</label>
            <div className={'col-sm-10'}>
              <input type="text" className={'form-control'} onChange={(elem) => onChange(elem)} name="email" id="email" />
            </div>
          </div>
          <div className={'form-group row'}>
            <label htmlFor="password" className={'col-sm-2 col-form-label'}>Password</label>
            <div className={'col-sm-10'}>
              <input type="password" onChange={(elem) => onChange(elem)} name="password" className={'form-control'} id="password" />
            </div>
          </div>
          <div className={'form-group row'}>
            <label htmlFor="password" className={'col-sm-2 col-form-label'}></label>
            <div className={'col-sm-10'}>
              <input type="submit" name="login" className={'btn btn-primary login loginmodal-submit'} value="Register" />
            </div>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Form;
