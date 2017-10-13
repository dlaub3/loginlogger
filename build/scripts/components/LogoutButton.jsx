import React from 'react';
import 'whatwg-fetch';
import { connect } from 'react-redux';
import store from '../store';
import {persistStore, AsyncStorage } from 'redux-persist';


class LogoutButton extends React.Component {
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
    return (
      <div>
      <button onClick={this.handleClick}> Logout </button>
          {/*this.state.msg ? this.handleMsg() : null*/}
      </div>
    );
  }
  handleClick(e) {
    e.preventDefault();
    this.handleFetch();
  }
  handleFetch() {
    fetch('/app/logout.php', {
        method: 'get',
        credentials: 'include'
    })
    .then(response => response.json())
    .then(data =>  {
      // display data
      if(data.error.length !== 0) {
        this.setState({
          msg: data.error
        });
      }
      else if(data.success) {
       store.dispatch({
            type: 'LOGIN',
            auth: false
          });
       this.setState({
          msg: data.success,
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
    if (this.state.msg) {
      msg = this.state.msg.map((msg) => {return <p>{msg}</p>})
    }
    return msg;
  }
}

const mapLoginStateToProps = function(store) {
  return {
    auth: store.loginState.auth
    };
}

export default connect(mapLoginStateToProps)(LogoutButton);

//presist redux store to localstorage
persistStore(store, {storage: AsyncStorage});
