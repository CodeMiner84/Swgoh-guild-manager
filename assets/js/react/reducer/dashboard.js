import types from '../actionType/dashboard'

const initialState = {
  products: [],
}

function dashboardReducer(state = initialState, action) {
  switch (action.type) {
    case types.DASHBOARD_PRODUCTS:
      return {
        ...state,
        products: action.payload,
      }
    default:
      return state
  }
}

export default dashboardReducer
