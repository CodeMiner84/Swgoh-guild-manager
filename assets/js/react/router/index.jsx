import React from 'react';
import { Route } from 'react-router';
import Cart from '../components/Cart';
import Main from '../components/Layout';
import Account from '../components/Account';
import Search from '../components/Search';
import Guild from '../components/Guild';
import User from '../components/Users';
import Character from '../components/Characters';

const mainRoutes = (<Route key="main" component={Main}>
  <Route key="dashboard" path="/" component={Guild} />
  <Route key="users" path="/users/:code" component={User} />
  <Route key="characters" path="/characters" component={Character} />
  <Route key="cart" path="cart" component={Cart} />
  <Route key="account" path="account" component={Account} />
  <Route key="search" path="search" component={Search} />
</Route>);

export default [
  mainRoutes,
];
