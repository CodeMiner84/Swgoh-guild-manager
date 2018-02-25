import types from '../actionType/user_squad_group'

const initialState = {
  user_squad_groups: [],
  isLoading: true,
}

function userSquadGroupReducer(state = initialState, action) {
  switch (action.type) {
    case types.USER_SQUAD_GROUP_REQUEST:
      return {
        ...state,
        isLoading: true,
      }
    case types.CREATE_USER_SQUAD_GROUP:
      return {
        ...state,
        isLoading: false,
      }
    case types.USER_SQUAD_GROUP_ERROR:
      return {
        ...state,
        isLoading: false,
      }
    case types.RECV_USER_SQUAD_GROUPS:
      return {
        ...state,
        isLoading: false,
        user_squad_groups: action.payload,
      }
    case types.REMOVE_USER_SQUAD_GROUP:
      return {
        ...state,
        user_squad_groups: state.user_squad_groups.filter(squad => squad.id !== action.id),
        isLoading: false,
      }
    default:
      return state
  }
}

export default userSquadGroupReducer
