import types from '../actionType/guild_squads'

const initialState = {
  guild_squads: [],
  isLoading: true,
  isLoading2: true,
  squad: [],
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
    case types.UPDATE_SQUAD_COLLECTION:
      return {
        ...state,
        isLoading: false,
      }
    case types.RECV_SQUAD_COLLECTION:
      return {
        ...state,
        squad: action.payload,
        isLoading: false,
      }
    case types.RECV_SQUAD:
      return {
        ...state,
        guild_squads: action.payload,
        isLoading: false,
      }
    case types.REMOVE_SQUAD:
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
