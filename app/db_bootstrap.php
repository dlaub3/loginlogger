<?php
require_once('db.php');

//create connection
$db = new mysqli(DB_SERV, DB_USER, DB_PASS, DB_NAME);

$msg = ["error" => [], "success" => []];

//verify connection
if ($db->connect_error) {
    echo $conn->connect_error;
    array_push($msg['error'], "Could not establish DB connection. :( ");
}


//check if tables already exist


//by default don't create the databases

$check_users = "SELECT *
             FROM information_schema.tables
             WHERE table_schema = 'mysqldb'
                 AND table_name = 'users'
             LIMIT 1";
$users = $db->query($check_users);

$check_login = "SELECT *
             FROM information_schema.tables
             WHERE table_schema = 'mysqldb'
                 AND table_name = 'login_attempts'
             LIMIT 1";
$login = $db->query($check_login);


// if the result set is empty
// the tables doesn't exist
// TODO setup to inform when a table exists
if (mysqli_num_rows($users) >= 1 && mysqli_num_rows($login) >= 1) {
    array_push($msg["success"], "The databases already exist. :)");
    echo json_encode($msg);
    exit;
}


//create tables

$user_table = "CREATE TABLE users(
                id INT(11) NOT NULL AUTO_INCREMENT,
                email VARCHAR(255),
                hashed_password VARCHAR(255),
                PRIMARY KEY (id)
               )";

$login_table =  "CREATE TABLE login_attempts(
                id INT(11) NOT NULL AUTO_INCREMENT,
                success TINYINT(1),
                email VARCHAR(255),
                date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
               )";

    if ($db->query($user_table)) {
        array_push($msg["success"], "Table 'users' was created successfully! :)");
    } else {
        array_push($msg["error"], "Table 'users' was NOT created successfully :( ");
    }

    if ($db->query($login_table)) {
        array_push($msg["success"], "Table 'login_attempts' was created successfully! :)");
    } else {
        array_push($msg["error"], "Table 'login_attempts' was NOT created successfully :( ");
    }

echo json_encode($msg);

$db->close();
