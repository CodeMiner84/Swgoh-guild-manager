import React from 'react';
import { Link } from 'react-router-dom'

const Form = ({ handleSubmit, onChange, error }) => {
  return (
    <div className={'d-flex justify-content-center'}>
      <div className={'border col-sm-6 px-5 pt-4 pb-3'}>
        <form className="" onSubmit={handleSubmit}>
          {error &&
          <div className={'form-group'}>
            <div className={'alert alert-danger'}>{error}</div>
          </div>
          }
          <div className={'form-group row'}>
            <div className={'col-xs-12'}>
              Login or <Link to={'/register'}>REGISTER</Link> if you don't have account yet.
            </div>
          </div>
          <div className={'form-group row'}>
            <label htmlFor="email" className={'col-sm-2 col-form-label'}>Username</label>
            <div className={'col-sm-10'}>
              <input type="text" className={'form-control'} onChange={(elem) => onChange(elem)} name="username" id="staticEmail" />
            </div>
          </div>
          <div className={'form-group row'}>
            <label htmlFor="password" className={'col-sm-2 col-form-label'}>Password</label>
            <div className={'col-sm-10'}>
              <input type="password" onChange={(elem) => onChange(elem)} name="password" className={'form-control'} id="password" />
            </div>
          </div>
          <div className={'form-group row'}>
            <input type="submit" name="login" className={'login loginmodal-submit'} value="Login" />
          </div>
        </form>
      </div>
    </div>
  );
};

export default Form;
