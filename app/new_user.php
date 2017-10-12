<?php

require_once('db.php');

if (!isset($_POST)) {
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

function new_user($email, $password)
{
    $db = new mysqli(DB_SERV, DB_USER, DB_PASS, DB_NAME);
    $msg = ["error" => [], "success" => []];

  //verify connection
  if ($db->connect_error) {
      echo $db->connect_error;
      array_push($msg['error'], "Could not establish DB connection. :( ");
  } else {
      array_push($msg['success'], "Established DB connection. :) ");
  }
    // prepare and bind
    $stmt = $db->prepare("INSERT INTO users ( email, hashed_password )
          VALUES (?, ?)");
    $email = $email;
    $password = password_hash($password, PASSWORD_DEFAULT);
    array_push($msg['error'], htmlspecialchars($db->error));
    $stmt->bind_param("ss", $email, $password);
    array_push($msg['error'], htmlspecialchars($stmt->error));
    $stmt->execute();
    array_push($msg['error'], htmlspecialchars($stmt->error));
    $stmt->close();
    $db->close();

    return json_encode($msg);
}

$log = new_user($email, $password);
echo $log;

// log all login attempts to DB
// create DB tables for users / login attemps
// Check username/password in DB
// Set Session variable
// require session varible to view Dashboard
