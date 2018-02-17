import { reactLocalStorage } from 'reactjs-localstorage'

export function isAuth() {
  return !!reactLocalStorage.get('token')
}

export function setToken(token) {
  return reactLocalStorage.set('token', token)
}

export function logout() {
  reactLocalStorage.clear()
}

