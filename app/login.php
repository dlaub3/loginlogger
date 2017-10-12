<?php
require_once('db.php');

if (!isset($_POST)) {
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

function log_loggin($email, $success)
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
    $stmt = $db->prepare("INSERT INTO login_attempts (success, email)
          VALUES (?, ?)");
    $stmt->bind_param("ss", $success, $email);
    $stmt->execute();
    //
    // if ($db->query($sql) === true) {
    //     array_push($msg['success'], "New record created successfully");
    // } else {
    //     array_push($msg['error'], $conn->error);
    // }
    $stmt->close();
    $db->close();

    return json_encode($msg);
}

$log = log_loggin($email, 1);
echo $log;

// log all login attempts to DB
// create DB tables for users / login attemps
// Check username/password in DB
// Set Session variable
// require session varible to view Dashboard
