import React from 'react';
import { Redirect } from 'react-router-dom';
import 'whatwg-fetch';
import { connect } from 'react-redux';
import store from '../store';
import {persistStore, AsyncStorage } from 'redux-persist';

class Dashboard extends React.Component {
  constructor() {
    super();
    this.state = {
      msg: ""
    }
    this.handleClick = this.handleClick.bind(this);
    this.handleFetch = this.handleFetch.bind(this);
    this.handleMsg = this.handleMsg.bind(this);
  }

  render() {
    if(!this.props.auth) {
      return <Redirect to="/login" />;
    }
    return (
      <div className="login-container">
       <ul className="logins">
       <li>
         <span className="id">ID</span>
         <span className="email">Email</span>
         <span className="date">Date</span>
         <span className="success">Success</span>
      </li>
          {this.state.msg ? this.handleMsg() : <p> Something went wrong. :(</p>}
       </ul>
      </div>
    );
  }
  componentWillMount(){
    this.handleFetch();
  }
  handleClick(e) {
    e.preventDefault();
    this.handleFetch();
  }
  handleFetch() {
    fetch('/app/dashboard.php', {
        method: 'get',
        credentials: 'include'
    })
    .then(response => response.json())
    .then(data =>  {
      // display data
      if(data) {
        this.setState({
          msg: data,
        });
      } else {
        console.log(data);
      }
    })
    .catch(function(err) {
      // if errors
      // this is for development
      // only!
      console.log(err)
    });
  }
  handleMsg() {
    let msg = [];
    if (this.state.msg[0].error) {
      msg = this.state.msg.map((msg) => {
        return <div>
                <span>{msg.error}</span>
              </div>})
    } else {
      msg = this.state.msg.map((msg, index) => {
        return <li key={index}>
                <span className="id">{msg.id}</span>
                <span className="email">{msg.email}</span>
                <span className="date">{msg.date}</span>
                <span className="success">{msg.success}</span>
              </li>})
    }
    return msg;
  }
}
const mapLoginStateToProps = function(store) {
  return {
    auth: store.loginState.auth
    };
}
export default connect(mapLoginStateToProps)(Dashboard);

//presist redux store to localstorage
persistStore(store, {storage: AsyncStorage});
