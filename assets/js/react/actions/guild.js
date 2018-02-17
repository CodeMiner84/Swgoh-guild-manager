import { get } from '../utils/requests'
import types from '../actionType/guild'

function fetchGuilds() {
  return dispatch => get('/api/guild')
      .then((response) => {
        dispatch({
          type: types.GUILD_LIST,
          payload: response.data.data,
        })
      })
}

function fetchGuildUsers(guildId, guildCode) {
  return (dispatch) => {
    dispatch({
      type: types.REQUEST_GUILD,
    })

    return get(`/api/guild/all/${guildId}/${guildCode}`)
      .then((response) => {
        dispatch({
          type: types.RECV_GUILD_USERS,
          payload: response.data.data,
        })
      })
  }
}

export default {
  fetchGuilds,
  fetchGuildUsers,
}
