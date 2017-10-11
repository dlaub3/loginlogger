import React from 'react';
import LoginForm from './LoginForm.jsx';
import 'whatwg-fetch';

export default class App extends React.Component {
  constructor() {
    super();
    this.state = {
      username: 'John',
      password: 'pass'
    }
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  render() {
    return (
      <div>
        <LoginForm onSubmit={this.handleSubmit}
               onChange = {this.handleChange}
        />
      </div>
    );
  }
  handleSubmit(e) {
    e.preventDefault();
    alert([this.state.username, this.state.password]);
    fetch('/app/login.php', {
        method: 'post',
        headers: {
          "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: `username=${this.state.username}&password=${this.state.password}`
    })
    .then(function(response) {
      // display data
      alert(response);
    })
    .catch(function(err) {
      // if errors
    });

  }
  handleChange(e) {
    if (e.target.name === 'password') {
      this.setState({password: e.target.value});
    }
    if (e.target.name === 'username') {
      this.setState({username: e.target.value});
    }
  }
}
