import types from '../actionType/user_squad'

const initialState = {
  user_squad: [],
  isLoading: true,
}

function userSquadReducer(state = initialState, action) {
  switch (action.type) {
    case types.USER_SQUAD_REQUEST:
      return {
        ...state,
        isLoading: true,
      }
    case types.CREATE_USER_SQUAD:
      return {
        ...state,
        isLoading: false,
      }
    case types.USER_SQUAD_ERROR:
      return {
        ...state,
        isLoading: false,
      }
    case types.RECV_USER_SQUADS:
      return {
        ...state,
        isLoading: false,
        user_squad: action.payload,
      }
    case types.REMOVE_USER_SQUAD:
      return {
        ...state,
        user_squad: state.user_squad.filter(squad => squad.id !== action.id),
        isLoading: false,
      }
    default:
      return state
  }
}

export default userSquadReducer
