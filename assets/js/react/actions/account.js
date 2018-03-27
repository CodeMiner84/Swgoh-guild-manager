import types from '../actionType/account'
import { get } from '../utils/requests'

function getAccount() {
  return (dispatch) => {
    dispatch({
      type: types.IS_LOADING,
    })

    return get('/api/account/me')
      .then((response) => {
        dispatch({
          type: types.RECV_ACCOUNT,
          payload: response.data,
        })
      })
  }
}


function logoutUser() {
  return (dispatch) => {
    return dispatch({
      type: types.LOGOUT_USER,
    })
  }
}

function fetchPersonalCollection(phrase = '') {
  return (dispatch) => {
    dispatch({
      type: types.IS_LOADING,
    })

    return get(`/api/collection?noLimit&phrase=${phrase || ''}`)
      .then((response) => {
        dispatch({
          type: types.USER_CHARACTERS_LIST,
          payload: response.data.data,
        })
      }).catch(() => {
        dispatch({
          type: types.RECV_ERROR,
        })
      })
  }
}

export default {
  getAccount,
  logoutUser,
  fetchPersonalCollection,
}
