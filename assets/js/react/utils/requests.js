import axios from 'axios';
import authHeader from '../utils/headers';

function get(url, params) {
  return axios.get(url, {
    ...params,
    headers: authHeader(),
  });
}
function post(url, params) {
  return axios.post(url, {
    ...params,
    headers: authHeader(),
  });
}

export {
  get,
  post,
};
