import types from '../actionType/search'

const initialState = {
  products: [],
}

function searchReducer(state = initialState, action) {
  switch (action.type) {
    case types.SEARCH_PRODUCTS:
      return {
        ...state,
        products: action.payload,
      }
    default:
      return state
  }
}

export default searchReducer
