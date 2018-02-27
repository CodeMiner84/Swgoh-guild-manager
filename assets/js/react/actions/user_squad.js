import { post, get, patch, remove } from '../utils/requests'
import types from '../actionType/user_squad'

const requestSquad = () => ({
  type: types.USER_SQUAD_REQUEST,
})

const createSquad = response => ({
  type: types.CREATE_USER_SQUAD,
  payload: response.data,
})

const updateUserSquad = response => ({
  type: types.UPDATE_USER_SQUAD,
  payload: response.data,
})

const errorResponse = response => ({
  type: types.USER_SQUAD_ERROR,
  payload: response.data,
})

const fetchSquad = response => ({
  type: types.RECV_USER_SQUADS,
  payload: response.data,
})

const removeSquadType = (response, id) => ({
  type: types.REMOVE_USER_SQUAD,
  payload: response.data,
  id,
})

const getCollectionType = response => ({
  type: types.RECV_USER_SQUAD_COLLECTION,
  payload: response,
})

const updateCollectionType = response => ({
  type: types.UPDATE_USER_SQUAD_COLLECTION,
  payload: response.data,
})

function fetch(groupId) {
  return (dispatch) => {
    dispatch(requestSquad())

    return get(`/api/user-squad/${groupId}`)
      .then(response => dispatch(fetchSquad(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function create(groupId, params) {
  return (dispatch) => {
    dispatch(requestSquad())

    return post(`/api/user-squad/${groupId}/add`, params).then(response =>
      dispatch(createSquad(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function update(groupId, squadId, params) {
  return (dispatch) => {
    dispatch(requestSquad())

    return patch(`/api/user-squad/${groupId}/edit/${squadId}`, params)
      .then(response => dispatch(updateUserSquad(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function removeSquad(groupId, id) {
  return (dispatch) => {
    dispatch(requestSquad())

    return remove(`/api/user-squad/${groupId}/${id}`)
      .then(response => dispatch(removeSquadType(response.data, id)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function getCollection(groupId, squadId) {
  return (dispatch) => {
    dispatch(requestSquad())

    return get(`/api/user-squad/${groupId}/collection/${squadId}`)
      .then(response => dispatch(getCollectionType(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function updateCollection(groupId, squadId, params) {
  return (dispatch) => {
    dispatch(requestSquad())

    return patch(`/api/user-squad/${groupId}/collection/${squadId}`, params)
      .then(response => dispatch(updateCollectionType(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

export default {
  create,
  fetch,
  update,
  removeSquad,
  getCollection,
  updateCollection,
}
