import React from 'react';

const Login = function (props) {
  return (
    <div>
      <form className="" action="/app/login.php" method="post">
        <label htmlFor="username">Name:</label>
        <input type="text" name="username" value={props.value} /><br/>
        <label htmlFor="password">Password:</label>
        <input type="password" name="password" value={props.value} /><br/>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
  );
};

module.exports = Login;
