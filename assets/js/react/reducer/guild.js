import types from '../actionType/guild';

const initialState = {
  guilds: [],
};

function guildReducer(state = initialState, action) {
  switch (action.type) {
    case types.GUILD_LIST:
      return {
        ...state,
        guilds: action.payload,
      };
    default:
      return state;
  }
}

export default guildReducer;
