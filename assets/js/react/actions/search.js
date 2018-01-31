import axios from 'axios';
import types from '../actionType/search';

function fetchProducts(phrase) {
  return (dispatch) => {
    return axios.get(`api/search?phrase=${phrase ? phrase : ''}`)
      .then((response) => {
        dispatch({
          type: types.SEARCH_PRODUCTS,
          payload: response.data.data,
        });
      });
  };
}

export default {
  fetchProducts,
};
