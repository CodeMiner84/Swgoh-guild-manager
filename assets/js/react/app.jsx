import React from 'react'
import { Provider } from 'react-redux'
import ReactDOM from 'react-dom'
import { createBrowserHistory } from 'history'
import { BrowserRouter, Route, Router } from 'react-router-dom'
import { PersistGate } from 'redux-persist/es/integration/react'
import Main from './components/Layout'
import store from './store/index'

import createAppStore from './store/storage'
const history = createBrowserHistory()
//const { persistor, store } = createAppStore()

ReactDOM.render((
  <Provider store={store}>
    <Router history={history}>
      <Main/>
    </Router>
  </Provider>
), document.getElementById('root'))
