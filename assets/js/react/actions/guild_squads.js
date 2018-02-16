import { post, get, patch } from '../utils/requests'
import types from '../actionType/guild_squads'

function create(params) {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_SQUAD,
    })

    return post('/api/guild-squads/', params)
      .then((response) => {
        dispatch({
          type: types.ADD_SQUADS,
          payload: response.data.data,
        })
      })
      .catch(() => dispatch({
        type: types.ERROR_SQUAD,
      }))
  }
}

function update(id, params) {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_SQUAD,
    })

    return patch(`/api/guild-squads/${id}`, params)
      .then((response) => {
        dispatch({
          type: types.UPDATE_SQUAD,
          payload: response.data.data,
        })
      })
      .catch(() => dispatch({
        type: types.ERROR_SQUAD,
      }))
  }
}

function updateCollection(id, params) {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_SQUAD,
    })

    return patch(`/api/guild-squads-collection/${id}/collection`, params)
      .then((response) => {
        dispatch({
          type: types.UPDATE_SQUAD_COLLECTION,
          payload: response.data.data,
        })
      })
      .catch(() => dispatch({
        type: types.ERROR_SQUAD,
      }))
  }
}

function getCollection(id) {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_SQUAD,
    })

    return get(`/api/guild-squads-collection/${id}/collection`)
      .then((response) => {
        dispatch({
          type: types.RECV_SQUAD_COLLECTION,
          payload: response.data.data,
        })
      })
      .catch(() => dispatch({
        type: types.ERROR_SQUAD,
      }))
  }
}

function getAll() {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_SQUAD,
    })

    return get('/api/guild-squads/')
      .then((response) => {
        dispatch({
          type: types.RECV_SQUAD,
          payload: response.data.data,
        })
      })
      .catch(() => dispatch({
        type: types.ERROR_SQUAD,
      }))
  }
}

export default {
  create,
  getAll,
  update,
  updateCollection,
  getCollection,
}
