import React from 'react';
import { Redirect } from 'react-router-dom';
import 'whatwg-fetch';
import validation from '../validation.js';
import { connect } from 'react-redux';
import store from '../store';

class NewUserForm extends React.Component {

  constructor() {
    super();
    this.state = {
      email: '',
      password: '',
      error: null,
      success: false
    }
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleValidation = this.handleValidation.bind(this);
    this.handleError = this.handleError.bind(this);
    this.handleFetch = this.handleFetch.bind(this);
  }

  render() {
    if(this.state.success){
    return <Redirect to="/login" />;
    }
    if(this.props.auth) {
      return <Redirect to="/dashboard" />;
    }
    return (
      <div className="flex-column">
        <form onSubmit={this.handleSubmit} className="" action="/app/new_user.php" method="post">
          <input type="email" name="email" value={this.state.value} onChange={this.handleChange} placeholder="Email"/><br/>
          <input type="password" name="password" value={this.state.value} onChange={this.handleChange} placeholder="Password"/><br/>
          <button type="submit" name="login">Create Account</button>
        </form>
          {this.state.error ? this.handleError() : null}
      </div>
    );
  }
  handleSubmit(e) {
    e.preventDefault();
    if (this.handleValidation()) {
      this.handleFetch();
    }
  }
  handleChange(e) {
    if (e.target.name === 'password') {
      this.setState({password: e.target.value});
    }
    if (e.target.name === 'email') {
      this.setState({email: e.target.value});
    }
  }
  handleFetch() {
    fetch('/app/new_user.php', {
      method: 'post',
      credentials: 'include',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: `email=${this.state.email}&password=${this.state.password}`
    }).then(response => response.json()).then(data => {
      // display data
      if(data.error.length !== 0) {
        this.setState({error: data.error});
      }
      if(data.success){
        this.setState({success: true});
      }
      console.log(data);
    }).catch(function(err) {
      // if errors
      // this is for development
      // only!
      console.log(err);
    });
  }
  handleValidation() {
    let options = {
      max: 15,
      min: 6
    };
    let password = this.state.password;
    let isValid = validation.validatePassword(password, options);
    if (isValid === true) {
      this.setState({error: null});
      return true;
    } else {
      this.setState({error: isValid});
      this.handleError();
    }
  }
  handleError() {
    let msg = [];
    if (this.state.error) {
      msg = this.state.error.map((msg) => {
        return <p>{msg}</p>
      })
    }
    return msg;
  }
}

const mapLoginStateToProps = function(store) {
  return {
    auth: store.loginState.auth
    };
}

export default connect(mapLoginStateToProps)(NewUserForm);
