import { browserHistory } from 'react-router';

export function isAuth() {
  return !!localStorage.getItem('token');
}

export function logout() {
  localStorage.removeItem('token');

  browserHistory.push('/login');
}

