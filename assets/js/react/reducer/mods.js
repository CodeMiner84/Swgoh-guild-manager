import types from '../actionType/mods'

const initialState = {
  settings: [],
  isLoading: false,
}

function modsReducer(state = initialState, action) {
  switch (action.type) {
    case types.REQUEST_MODS:
      return {
        ...state,
        isLoading: true,
      }
    case types.RECV_MODS_SETTINGS:
      return {
        ...state,
        isLoading: false,
        settings: action.payload,
      }
    default:
      return state
  }
}

export default modsReducer

