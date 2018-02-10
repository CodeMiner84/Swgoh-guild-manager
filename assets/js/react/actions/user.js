import axios from 'axios';
import types from '../actionType/user';
import { get, post } from '../utils/requests';

function fetchUsers() {
  return dispatch => axios.get('/api/users')
      .then((response) => {
        dispatch({
          type: types.USER_LIST,
          payload: response.data.data,
        });
      });
}
function fetchUserCharacter(code, phrase = '') {
  return dispatch => axios.get(`/api/user/characters/${code}?noLimit&phrase=${phrase || ''}`)
    .then((response) => {
      dispatch({
        type: types.USER_CHARACTERS_LIST,
        payload: response.data.data,
      });
    });
}

function updateAccount(data) {
  return dispatch => post('/api/account/', data)
    .then((response) => {
      dispatch({
        type: types.USER_CHARACTERS_LIST,
        payload: response.data.data,
      });
    });
}

export default {
  fetchUsers,
  fetchUserCharacter,
  updateAccount
};
