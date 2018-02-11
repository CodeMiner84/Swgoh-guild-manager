import React from 'react'
import { Provider } from 'react-redux'
import ReactDOM from 'react-dom'
import {
  BrowserRouter,
} from 'react-router-dom'

import store from './store'
import Main from './components/Layout'

ReactDOM.render((
  <Provider store={store}>
    <BrowserRouter>
      <Main />
    </BrowserRouter>
  </Provider>
), document.getElementById('root'))
