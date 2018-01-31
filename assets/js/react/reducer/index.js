import { combineReducers } from 'redux';
import dashboardReducer from './dashboard';
import searchReducer from './search';
import guildReducer from './guild';
import usersReducer from './user';
import characterReducer from './character';

const rootReducer = combineReducers({
  dashboard: dashboardReducer,
  search: searchReducer,
  guild: guildReducer,
  user: usersReducer,
  character: characterReducer,
});

export default rootReducer;
