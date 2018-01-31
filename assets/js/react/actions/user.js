import axios from 'axios';
import types from '../actionType/user';

function fetchUsers() {
  return (dispatch) => {
    return axios.get('/api/users')
      .then((response) => {
        dispatch({
          type: types.USER_LIST,
          payload: response.data.data,
        });
      });
  };
}

export default {
  fetchUsers,
};
