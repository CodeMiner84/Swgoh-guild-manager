import types from '../actionType/account'

const initialState = {
  auth: [],
  userCharacters: [],
  isLoading: false,
}

function accountReducer(state = initialState, action) {
  switch (action.type) {
    case types.IS_LOADING:
      return {
        ...state,
        isLoading: true,
      }
    case types.RECV_ACCOUNT:
      return {
        ...state,
        auth: action.payload,
        isLoading: false,
      }
    case types.UPDATE_ACCOUNT:
      return {
        ...state,
        auth: action.payload,
        isLoading: false,
      }
    case types.USER_CHARACTERS_LIST:
      return {
        ...state,
        userCharacters: action.payload,
        isLoading: false,
      }
    case types.RECV_ERROR:
      return {
        ...state,
        isLoading: false,
        userCharacters: null,
      }
    default:
      return state
  }
}

export default accountReducer
