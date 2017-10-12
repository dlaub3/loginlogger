<?php
require_once('initialize.php');


function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function require_login()
{
    if (!is_logged_in()) {
        // error
    $msg = [["error" => "You need to login."]];
        echo json_encode($msg);
        exit;
    } else {
        // success
        return true;
    }
}


function getData()
{
    $db = new mysqli(DB_SERV, DB_USER, DB_PASS, DB_NAME);
    $msg = ["error" => [], "success" => []];

    //verify connection
    if ($db->connect_error) {
        echo $db->connect_error;
        array_push($msg['error'], "Could not establish DB connection. :( ");
    }

    $sql = "SELECT * FROM login_attempts";
    $result = $db->query($sql);
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    $db->close();
    return json_encode($outp);
}
require_login();
$data = getData();
echo $data;
