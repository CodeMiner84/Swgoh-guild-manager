import types from '../actionType/user'

const initialState = {
  users: [],
  userCharacters: [],
}

function usersReducer(state = initialState, action) {
  switch (action.type) {
    case types.IS_LOADING:
      return {
        ...state,
        isLoading: true,
      }
    case types.USER_LIST:
      return {
        ...state,
        users: action.payload,
        isLoading: false,
      }
    case types.RECV_USER:
      return {
        ...state,
        logged: action.payload,
        isLoading: false,
      }
    case types.RECV_ERROR:
      return {
        ...state,
        isLoading: false,
      }
    case types.SYNCHRONIZE_ACCOUNT:
      return {
        ...state,
        isLoading: false,
      }
    default:
      return state
  }
}

export default usersReducer
