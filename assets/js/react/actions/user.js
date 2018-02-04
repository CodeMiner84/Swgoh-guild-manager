import axios from 'axios';
import types from '../actionType/user';

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

export default {
  fetchUsers,
  fetchUserCharacter,
};
