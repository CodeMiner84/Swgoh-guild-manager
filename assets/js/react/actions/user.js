import types from '../actionType/user'
import { get, patch, post } from '../utils/requests'

function fetchUsers() {
  return dispatch => get('/api/users')
      .then((response) => {
        dispatch({
          type: types.USER_LIST,
          payload: response.data.data,
        })
      })
}

function fetchUserCharacter(code, phrase = '') {
  return dispatch => get(`/api/collection/${code}?noLimit&phrase=${phrase || ''}`)
    .then((response) => {
      dispatch({
        type: types.USER_CHARACTERS_LIST,
        payload: response.data.data,
      })
    })
}

function fetchPersonalCollection(phrase = '') {
  return dispatch => get(`/api/collection?noLimit&phrase=${phrase || ''}`)
    .then((response) => {
      dispatch({
        type: types.USER_CHARACTERS_LIST,
        payload: response.data.data,
      })
    })
}

function updateAccount(data) {
  return dispatch => patch('/api/account/', data)
    .then((response) => {
      dispatch({
        type: types.UPDATE_ACCOUNT,
        payload: response.data.data,
      })
    })
}

export default {
  fetchUsers,
  fetchUserCharacter,
  fetchPersonalCollection,
  updateAccount,
}
