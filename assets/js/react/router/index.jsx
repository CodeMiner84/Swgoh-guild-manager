import React from 'react';
import { Route } from 'react-router-dom';
import Cart from '../components/Cart';
import Main from '../components/Layout';
import Dashboard from '../components/Dashboard';
import Account from '../components/Account';
import Search from '../components/Search';
import Guild from '../components/Guild';
import Users from '../components/Users';
import User from '../components/User';
import Character from '../components/Characters';
import Login from '../components/Login';

const mainRoutes = (<Route key="main" component={Main}>
  <div>
    <Route key="dashboard" path="/" component={Dashboard} />
    <Route key="guilds" path="/guilds" component={Guild} />
    <Route key="users" path="/users/:code" component={Users} />
    <Route key="user" path="/user/:code" component={User} />
    <Route key="characters" path="/characters" filtering component={Character} />
    <Route key="cart" path="cart" component={Cart} />
    <Route key="account" path="account" component={Account} />
    <Route key="search" path="search" component={Search} />
    <Route key="login" path="login" component={Login} />

</Route>);

export default [
  mainRoutes,
];
