import types from '../actionType/user';

const initialState = {
  users: [],
  userCharacters: [],
};

function usersReducer(state = initialState, action) {
  switch (action.type) {
    case types.USER_LIST:
      return {
        ...state,
        users: action.payload,
      };
    case types.USER_CHARACTERS_LIST:
      return {
        ...state,
        userCharacters: action.payload,
      };
    default:
      return state;
  }
}

export default usersReducer;
