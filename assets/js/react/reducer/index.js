import { combineReducers } from 'redux';
import dashboardReducer from './dashboard';
import searchReducer from './search';
import guildReducer from './guild';
import usersReducer from './user';
import characterReducer from './character';
import loginReducer from './login';

const rootReducer = combineReducers({
  dashboard: dashboardReducer,
  search: searchReducer,
  guild: guildReducer,
  user: usersReducer,
  character: characterReducer,
  login: loginReducer,
});

export default rootReducer;
