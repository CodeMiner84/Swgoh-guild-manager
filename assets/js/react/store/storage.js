import thunk from 'redux-thunk'
import { createLogger } from 'redux-logger'
import { createStore, applyMiddleware, compose } from 'redux'
import { persistStore, persistReducer } from 'redux-persist'
import storage from 'redux-persist/es/storage'
import reducer from '../reducer'

const loggerMiddleware = createLogger()
const middleware = [thunk, loggerMiddleware]
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose
const configureStore = composeEnhancers(
  applyMiddleware(...middleware),
)(createStore)

const config = {
  key: 'root',
  storage,
}

const combinedReducer = persistReducer(config, reducer)

const createAppStore = () => {
  const store = configureStore(combinedReducer)
  const persistor = persistStore(store)

  return { persistor, store }
}

export default createAppStore
