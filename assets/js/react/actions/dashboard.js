import axios from 'axios';
import types from '../actionType/dashboard';

function fetchProducts() {
  return (dispatch) => {
    return axios.get('api/dashboard/top')
      .then((response) => {
        dispatch({
          type: types.DASHBOARD_PRODUCTS,
          payload: response.data.data,
        });
      });
  };
}

export default {
  fetchProducts,
};
