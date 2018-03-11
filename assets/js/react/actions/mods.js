import types from '../actionType/mods'
import { get } from '../utils/requests'

function getSettings() {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_MODS,
    })

    return get('/api/mod/settings')
      .then((response) => {
        dispatch({
          type: types.RECV_MODS_SETTINGS,
          payload: response.data,
        })
      })
  }
}
export default {
  getSettings,
}
