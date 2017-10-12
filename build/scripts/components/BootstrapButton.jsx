import React from 'react';
import 'whatwg-fetch';

export default class BootstrapButton extends React.Component {
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
      <button onClick={this.handleClick}> Bootstrap </button>
          {this.state.msg ? this.handleMsg() : null}
      {this.props.children}
      </div>
    );
  }
  handleClick(e) {
    e.preventDefault();
    this.handleFetch();
  }
  handleFetch() {
    fetch('/app/db_bootstrap.php', {
        method: 'get',
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
        this.setState({
          msg: data.success,
        });
        this.props.toggleBootstrap();
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
