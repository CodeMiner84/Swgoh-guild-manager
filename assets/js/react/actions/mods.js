import types from '../actionType/mods'
import { get, post } from '../utils/requests'

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

function generate() {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_MODS,
    })

    return get('/api/mod/generate')
      .then((response) => {
        dispatch({
          type: types.GENERATE_MODS,
          payload: response.data,
        })
      })
  }
}

function saveMods(params) {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_MODS,
    })

    return post('/api/mod/save', params)
      .then((response) => {
        dispatch({
          type: types.SAVE_MODS,
          payload: response.data,
        })
      })
  }
}

function getMods() {
  return (dispatch) => {
    dispatch({
      type: types.RECV_MODS,
    })

    return get('/api/mod/get')
      .then((response) => {
        dispatch({
          type: types.RECV_MODS,
          payload: response.data.data[0] ? JSON.parse(response.data.data[0].mods) : {},
        })
      })
  }
}

export default {
  getSettings,
  saveMods,
  getMods,
  generate,
}
