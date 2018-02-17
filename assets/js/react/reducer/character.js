import types from '../actionType/character'

const initialState = {
  characters: [],
}

function characterReducer(state = initialState, action) {
  switch (action.type) {
    case types.CHARACTER_LIST:
      return {
        ...state,
        characters: action.payload,
      }
    default:
      return state
  }
}

export default characterReducer
