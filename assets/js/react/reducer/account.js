import types from '../actionType/account'

const initialState = {
  logged: [],
}

function accountReducer(state = initialState, action) {
  switch (action.type) {
    case types.RECV_ACCOUNT:
      return {
        ...state,
        logged: action.payload,
      }
    default:
      return state
  }
}

export default accountReducer
