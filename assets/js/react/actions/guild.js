import { get } from '../utils/requests';
import types from '../actionType/guild';

function fetchGuilds() {
  return (dispatch) => {
    return get('/api/guild')
      .then((response) => {
        dispatch({
          type: types.GUILD_LIST,
          payload: response.data.data,
        });
      });
  };
}

export default {
  fetchGuilds,
};
