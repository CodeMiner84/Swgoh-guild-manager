import React from 'react'
import { Provider } from 'react-redux'
import ReactDOM from 'react-dom'
import {
  BrowserRouter as Router,
  Route,
} from 'react-router-dom'

import store from './store'
import Main from './components/Layout'

ReactDOM.render((
  <Provider store={store}>
    <Router>
      <Main />
    </Router>
  </Provider>
), document.getElementById('root'))
