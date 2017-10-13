import React from 'react';
import 'whatwg-fetch';
import { connect } from 'react-redux';
import store from '../store';
import { Redirect } from 'react-router-dom';

class BootstrapButton extends React.Component {
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
    if(!this.props.tables) {
      return <Redirect to="/new-user" />;
    }
    return (
      <div className="flex-column">
      <p> You must first bootstrap the database. </p>
      {
        this.props.tables ?
        <button onClick={this.handleClick}> Bootstrap </button> :
        <div>Databases created successfully &#x1F44D; </div>
      }
          {/* This will display error message when it's hooked up.*/}
          {this.state.msg ? this.handleMsg() : null}
      </div>
    );
  }
  handleClick(e) {
    e.preventDefault();
    this.handleFetch();
  }
  handleFetch() {
    fetch('/app/bootstrap.php', {
        method: 'get',
    })
    .then(response => response.json())
    .then(data =>  {
      // display data
      if(data.success) {
        store.dispatch({
          type: 'BOOTSTRAP',
          bootstrap: false
        });
      } else {
        console.log(data);
      }
    })
    .catch(function(err) {
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

const mapBootstrapStateToProps = function(store) {
  return {
    tables: store.bootstrapState.tables
    };
}
// export default BootstrapButton;
export default connect(mapBootstrapStateToProps)(BootstrapButton);
