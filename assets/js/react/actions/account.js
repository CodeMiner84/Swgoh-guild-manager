import types from '../actionType/account'
import { get } from '../utils/requests'

function getAccount() {
  return dispatch => get('/api/account/me')
    .then((response) => {
      dispatch({
        type: types.RECV_ACCOUNT,
        payload: response.data.data,
      })
    })
}

export default {
  getAccount,
}
