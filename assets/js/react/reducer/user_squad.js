import types from '../actionType/user_squad'

const initialState = {
  user_squad_groups: [],
  isLoading: true,
}

function userSquadReducer(state = initialState, action) {
  switch (action.type) {
    case types.USER_SQUAD_REQUEST:
      return {
        ...state,
        isLoading: true,
      }
    case types.ADD_SQUAD_REQUEST:
      return {
        ...state,
      }
    default:
      return state
  }
}

export default userSquadReducer
