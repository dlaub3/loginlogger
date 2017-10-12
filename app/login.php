<?php
require_once('initialize.php');

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
    $stmt->close();
    $db->close();

    return json_encode($msg);
}

function login_user($user)
{
    session_regenerate_id();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['last_login'] = time();
    return true;
}


function get_user_by_email($email)
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
    $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $email, $hashed_password);
    ;
    $stmt->fetch();
    $stmt->close();
    $db->close();

    $data = array(id => $id, email => $email, hash => $hashed_password);
    return $data;
}

$user = get_user_by_email($email);

if ($user) {
    if (password_verify($password, $user['hash'])) {
        login_user($user);
        $msg = ["error" => [], "success" => ["Successful login!"]];
    } else {
        $msg = ["error" => [], "success" => ["Login error!"]];
    }
}
// $log = log_loggin($email, 1);

echo json_encode($msg);

// log all login attempts to DB
// create DB tables for users / login attemps
// Check username/password in DB
// Set Session variable
// require session varible to view Dashboard
