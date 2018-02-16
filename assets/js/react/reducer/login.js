import types from '../actionType/login'

const initialState = {
  user: [],
  submitted: false,
}

function loginReducer(state = initialState, action) {
  switch (action.type) {
    case types.LOGIN_REQUEST:
      return {
        ...state,
        submitted: true,
      }
    case types.LOGIN_SUCCESS:
      return {
        ...state,
        user: action.payload,
        submitted: false,
      }
    default:
      return state
  }
}

export default loginReducer
