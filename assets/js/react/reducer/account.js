import types from '../actionType/account'

const initialState = {
  auth: [],
}

function accountReducer(state = initialState, action) {
  switch (action.type) {
    case types.RECV_ACCOUNT:
      return {
        ...state,
        auth: action.payload,
      }
    case types.UPDATE_ACCOUNT:
      return {
        ...state,
        auth: action.payload,
      }
    default:
      return state
  }
}

export default accountReducer
