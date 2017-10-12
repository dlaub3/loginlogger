<?php

// Credentials

  define("DB_SERV", "mysql");
  define("DB_USER", "mysqluser");
  define("DB_PASS", "mysqlpassword");
  define("DB_NAME", "mysqldb");

  // addslashes();

  //Thee tenats of secure SQL
  //Single Quote all query data
  //escape all dynamic SQL query values
  //prepaired statements

      // prepair
      // bind
      // execure
      // bind result
      // fetch
      // close

  function mres($connection, $string)
  {
      mysqli_real_escape_string($connection, $string);
  }

// Create connection
// Run query
// Use data
// Release data
// Close connection

  // password_hash($password, PASSWORD_DEFAULT);
  // password_verify($password, $hashed_password);
