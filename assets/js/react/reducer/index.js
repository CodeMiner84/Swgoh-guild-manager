import { combineReducers } from 'redux'
import { reducer as formReducer } from 'redux-form'
import { routerReducer } from 'react-router-redux'
import dashboardReducer from './dashboard'
import guildReducer from './guild'
import usersReducer from './user'
import characterReducer from './character'
import loginReducer from './login'
import accountReducer from './account'

const rootReducer = combineReducers({
  dashboard: dashboardReducer,
  guild: guildReducer,
  user: usersReducer,
  character: characterReducer,
  login: loginReducer,
  form: formReducer,
  routing: routerReducer,
  account: accountReducer,
})

export default rootReducer
