import types from '../actionType/user';

const initialState = {
  users: [],
};

function usersReducer(state = initialState, action) {
  switch (action.type) {
    case types.USER_LIST:
      return {
        ...state,
        users: action.payload,
      };
    default:
      return state;
  }
}

export default usersReducer;
