import React from 'react';

const LoginForm = function (props) {
  return (
    <div>
      <form onSubmit={props.onSubmit} className="" action="/app/login.php" method="post">
        <label htmlFor="username">Name:</label>
        <input type="text" name="username"
            value={props.value}
            onChange={props.onChange}
        /><br/>
        <label htmlFor="password">Password:</label>
        <input type="password" name="password"
            value={props.value}
            onChange={props.onChange}
        /><br/>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
  );
};

module.exports = LoginForm;
