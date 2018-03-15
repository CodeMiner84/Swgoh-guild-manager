import types from '../actionType/mods'

const initialState = {
  settings: [],
  isLoading: false,
  mods: {},
  generated: {},
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
    case types.SAVE_MODS:
      return {
        ...state,
        isLoading: false,
        mods: action.payload,
      }
    case types.RECV_MODS:
      return {
        ...state,
        isLoading: false,
        mods: action.payload,
      }
    case types.GENERATE_MODS:
      return {
        ...state,
        isLoading: false,
        generated: action.payload,
      }
    default:
      return state
  }
}

export default modsReducer

