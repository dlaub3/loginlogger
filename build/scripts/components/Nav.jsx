import React from 'react';
import LogoutButton from './LogoutButton.jsx';
import { NavLink } from 'react-router-dom';
import { connect } from 'react-redux';
import store from '../store';

const Nav = function(props) {
  return(
    <nav>
      <ul>
        <li>
          <NavLink exact activeClassName='active' to='/'>
            Home
          </NavLink>
        </li>
        <li>
          <NavLink activeClassName='active' to='/new-user'>
            Create Account
          </NavLink>
        </li>
        <li>
          <NavLink activeClassName='active' to='/dashboard'>
            Dashboard
          </NavLink>
        </li>
        {
          props.auth ?
          <li> <LogoutButton /> </li> :
        <li>
          <NavLink activeClassName='active' to='/login'>
            Login
          </NavLink>
        </li>
       }
      </ul>
    </nav>
  )
};


const mapLoginStateToProps = function(store) {
  return {
    auth: store.loginState.auth
    };
}

export default connect(mapLoginStateToProps)(Nav);
