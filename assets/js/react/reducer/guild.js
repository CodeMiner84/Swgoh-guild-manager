import types from '../actionType/guild'

const initialState = {
  guilds: [],
  isLoading: false,
  users: [],
}

function guildReducer(state = initialState, action) {
  switch (action.type) {
    case types.GUILD_LIST:
      return {
        ...state,
        guilds: action.payload,
      }
    case types.REQUEST_GUILD:
      return {
        ...state,
        isLoading: true,
      }
    case types.RECV_GUILD_USERS:
      return {
        ...state,
        users: action.payload,
        isLoading: false,
      }
    default:
      return state
  }
}

export default guildReducer
