<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script type="text/javascript" src="/dist/bundle.js"></script>
  <title>Login Logger Login</title>
</head>
<body>
  <main>
    <h1> Login Logger Login </h1>
    <div id="app">

    </div>
    <form class="" action="/app/login.php" method="post">
      <label for="username">Name:</label>
      <input type="text" name="username" value=""><br/>
      <label for="password">Password:</label>
      <input type="password" name="password" value=""><br/>
      <button type="submit" name="login">Login</button>
    </form>

    <footer>
        <script type="text/javascript" src="/dist/bundle.js"></script>
    </footer>
  </main>
</body>
</html>
