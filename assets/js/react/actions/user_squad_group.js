import { post, get, patch, remove } from '../utils/requests'
import types from '../actionType/user_squad_group'

const requestSquadGroup = () => ({
  type: types.USER_SQUAD_GROUP_REQUEST,
})

const createSquadGroup = response => ({
  type: types.CREATE_USER_SQUAD_GROUP,
  payload: response.data,
})

const updateUserSquadGroup = response => ({
  type: types.UPDATE_USER_SQUAD_GROUP,
  payload: response.data,
})

const errorResponse = response => ({
  type: types.USER_SQUAD_GROUP_ERROR,
  payload: response.data,
})

const fetchSquadGroup = response => ({
  type: types.RECV_USER_SQUAD_GROUPS,
  payload: response.data,
})

const removeSquadGroupType = (response, id) => {
  return {
    type: types.REMOVE_USER_SQUAD_GROUP,
    payload: response.data,
    id,
  }
}

function create(params) {
  return (dispatch) => {
    dispatch(requestSquadGroup())

    return post('/api/user-squad-group/add', params).then(response =>
      dispatch(createSquadGroup(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function fetch() {
  return (dispatch) => {
    dispatch(requestSquadGroup())

    return get('/api/user-squad-group')
      .then(response => dispatch(fetchSquadGroup(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function update(id, params) {
  return (dispatch) => {
    dispatch(requestSquadGroup())

    return patch(`/api/user-squad-group/edit/${id}`, params)
      .then(response => dispatch(updateUserSquadGroup(response.data)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

function removeSquadGroup(id) {
  return (dispatch) => {
    dispatch(requestSquadGroup())

    return remove(`/api/user-squad-group/${id}`)
      .then(response => dispatch(removeSquadGroupType(response.data, id)))
      .catch(error => dispatch(errorResponse(error)))
  }
}

export default {
  create,
  fetch,
  update,
  removeSquadGroup,
}
