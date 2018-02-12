import types from '../actionType/guild_squads'

const initialState = {
  guild_squads: [],
  isLoading: false,
}

function guildSquadReducer(state = initialState, action) {
  switch (action.type) {
    case types.REQUEST_SQUAD:
      return {
        ...state,
        isLoading: true,
      }
    case types.UPDATE_SQUAD:
      return {
        ...state,
      }
    case types.RECV_SQUAD:
      return {
        ...state,
        guild_squads: action.payload,
        isLoading: false,
      }
    default:
      return state
  }
}

export default guildSquadReducer
