import axios from 'axios';
import types from '../actionType/login';

function login(username, password) {
  return (dispatch) => {
    dispatch({
      type: types.LOGIN_REQUEST,
      submited: true,
    });

    return axios.post('/api/login_check', {
      _username: username, _password: password
    })
      .then((response) => {
        if (response.data && response.data.token) {
          localStorage.setItem('token', response.data.token);
          dispatch({
            type: types.LOGIN_SUCCESS,
            payload: response.data,
          });
        }
      })
    ;
  };
}

export default {
  login,
};
