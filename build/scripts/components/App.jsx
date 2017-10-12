import React from 'react';
import LoginForm from './LoginForm.jsx';
import NewUserForm from './NewUserForm.jsx';
import BootstrapButton from './BootstrapButton.jsx';
import LogoutButton from './LogoutButton.jsx';
import Dashboard from './Dashboard.jsx';
import { Transition } from 'react-transition-group';


export default class App extends React.Component {

  constructor() {
    super();
    this.state = {
      toggleBootstrap: true,
    }
    this.toggleBootstrap = this.toggleBootstrap.bind(this);
  }

  render() {


    return (
      <div>
      <nav>
      <LogoutButton />
      <LoginForm />
      <Dashboard/>
      <NewUserForm />
      </nav>
        <div>
        { this.state.toggleBootstrap ?
          <BootstrapButton toggleBootstrap={this.toggleBootstrap} /> :
          <div>Databases created successfully &#x1F44D; </div>
        }
        </div>
      </div>
    );
  }
  toggleBootstrap() {
    this.setState({
      toggleBootstrap: !this.state.toggleBootstrap
    });
  }
}
