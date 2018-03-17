import { combineReducers } from 'redux'
import { reducer as formReducer } from 'redux-form'
import { routerReducer } from 'react-router-redux'
import dashboardReducer from './dashboard'
import guildReducer from './guild'
import guildSquadsReducer from './guild_squads'
import usersReducer from './user'
import characterReducer from './character'
import loginReducer from './login'
import accountReducer from './account'
import userSquadGroupReducer from './user_squad_group'
import modsReducer from './mods'
import userSquadReducer from './user_squad'

const rootReducer = combineReducers({
  account: accountReducer,
  character: characterReducer,
  dashboard: dashboardReducer,
  form: formReducer,
  guild: guildReducer,
  guild_squads: guildSquadsReducer,
  login: loginReducer,
  mods: modsReducer,
  routing: routerReducer,
  user: usersReducer,
  user_squad: userSquadReducer,
  user_squad_group: userSquadGroupReducer,
})

export default rootReducer
