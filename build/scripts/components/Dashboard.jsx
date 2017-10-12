import React from 'react';
import 'whatwg-fetch';

export default class Dashboard extends React.Component {
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
      <button onClick={this.handleClick}> Dashboard </button>
          {this.state.msg ? this.handleMsg() : null}
      </div>
    );
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
      msg = this.state.msg.map((msg) => {
        return <div>
                <span>{msg.id}</span>
                <span>{msg.email}</span>
                <span>{msg.date}</span>
                <span>{msg.success}</span>
              </div>})
    }
    return msg;
  }
}
