import { get } from '../utils/requests'
import types from '../actionType/dashboard'

function fetchProducts() {
  return dispatch => get('api/dashboard/top')
      .then((response) => {
        dispatch({
          type: types.DASHBOARD_PRODUCTS,
          payload: response.data.data,
        })
      })
}

export default {
  fetchProducts,
}
