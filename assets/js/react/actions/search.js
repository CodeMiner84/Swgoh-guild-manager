import { get } from '../utils/requests'
import types from '../actionType/search'

function fetchProducts(phrase) {
  return dispatch => get(`api/search?phrase=${phrase || ''}`)
      .then((response) => {
        dispatch({
          type: types.SEARCH_PRODUCTS,
          payload: response.data.data,
        })
      })
}

export default {
  fetchProducts,
}
