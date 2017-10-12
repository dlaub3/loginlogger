<?php

trait Log
{
    public function log_loggin($email, $success)
    {
        //initialize a database connection;
      $conn = new mysqli(DB_SERV, DB_USER, DB_PASS, DB_NAME);

        //verify connection
        // if ($conn->connect_error) {
        //   echo $conn->connect_error;
        // } else {
        // }
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO login_attempts (success, email)
          VALUES (?, ?)");
        $stmt->bind_param("ss", $success, $email);
        $stmt->execute();
        $stmt->close();
        //close databse connection
        $conn->close();
    }
}
