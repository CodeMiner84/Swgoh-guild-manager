import types from '../actionType/user'

const initialState = {
  users: [],
  userCharacters: [],
}

function usersReducer(state = initialState, action) {
  switch (action.type) {
    case types.USER_LIST:
      return {
        ...state,
        users: action.payload,
      }
    case types.USER_CHARACTERS_LIST:
      return {
        ...state,
        userCharacters: action.payload,
      }
    case types.UPDATE_ACCOUNT:
      return {
        ...state,
        account: action.payload,
      }
    case types.RECV_USER:
      return {
        ...state,
        logged: action.payload,
      }
    default:
      return state
  }
}

export default usersReducer
