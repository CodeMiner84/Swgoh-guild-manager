import axios from 'axios';
import types from '../actionType/character';

function fetchCharacters(phrase) {
  return dispatch => axios.get(`api/characters?noLimit`)
      .then((response) => {
        dispatch({
          type: types.CHARACTER_LIST,
          payload: response.data.data,
        });
      });
}

function filterCharacters(phrase) {
  return dispatch =>
    dispatch({
      type: types.FILTER_CHARACTER,
      payload: phrase,
    });
}

export default {
  fetchCharacters,
  filterCharacters,
};
