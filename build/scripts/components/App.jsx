import React from 'react';
import LoginForm from './LoginForm.jsx';
import NewUserForm from './NewUserForm.jsx';
import BootstrapButton from './BootstrapButton.jsx';
import Dashboard from './Dashboard.jsx';
import Nav from './Nav.jsx';
import { BrowserRouter, Route, Switch } from 'react-router-dom'
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
      <BrowserRouter>
      <div>
        <Nav />
        <Switch>
          <Route exact path='/' component={BootstrapButton} />
          <Route path='/login' component={LoginForm} />
          <Route path='/dashboard' component={Dashboard} />
          <Route path='/new-user' component={NewUserForm} />
          <Route render={function(){
            return <h4> Page Not Found </h4>;
          }} />
        </Switch>
      </div>
      </BrowserRouter>
    );
  }
  toggleBootstrap() {
    this.setState({
      toggleBootstrap: !this.state.toggleBootstrap
    });
  }
}
