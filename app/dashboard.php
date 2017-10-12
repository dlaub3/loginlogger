<?php
require_once('db.php');


function getData()
{
    $db = new mysqli(DB_SERV, DB_USER, DB_PASS, DB_NAME);
    $msg = ["error" => [], "success" => []];

  //verify connection
  if ($db->connect_error) {
      echo $db->connect_error;
      array_push($msg['error'], "Could not establish DB connection. :( ");
  }
    // prepare and bind
    // $stmt = $db->prepare("INSERT INTO login_attempts (success, email)
    //       VALUES (?, ?)");
    // $stmt->bind_param("ss", $success, $email);
    // $stmt->execute();
    //
    $sql = "SELECT * FROM login_attempts";
    $result = $db->query($sql);
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    $db->close();

    return json_encode($outp);
}

$data = getData();
echo $data;
