import axios from 'axios'
import authHeader from '../utils/headers'
import { logout } from '../utils/auth'

function get(url, params) {
  return axios.get(url, {
    ...params,
    headers: authHeader(),
  }).catch((response) => {
    logout()
  })
}
function post(url, params) {
  return axios.post(url, {
    ...params,
  },
    {
      headers: authHeader(),
    },
  )
}

export {
  get,
  post,
}
