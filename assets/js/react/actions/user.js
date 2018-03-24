import types from '../actionType/user'
import { get, patch, post } from '../utils/requests'

const loadingType = () => ({
  type: types.IS_LOADING,
})

const syncType = (response) => ({
  type: types.SYNCHRONIZE_ACCOUNT,
  payload: response.data,
})

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

function updateAccount(data) {
  return dispatch => patch('/api/account/', data)
    .then((response) => {
      dispatch({
        type: types.UPDATE_ACCOUNT,
        payload: response.data,
      })
    })
}

function synchronizeAccount() {
  return (dispatch) => {
    dispatch(loadingType())

    return post('/api/synchronize/account')
      .then(response => dispatch(syncType(response)))
  }
}

export default {
  fetchUsers,
  fetchUserCharacter,
  updateAccount,
  synchronizeAccount,
}
