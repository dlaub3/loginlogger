<?php
require_once('ClassDatabaseActions.php');


class Bootstrap extends DatabaseActions
{
    public function check_tables()
    {
        //check if tables already exist
    $check_users = "SELECT *
                 FROM information_schema.tables
                 WHERE table_schema = 'mysqldb'
                     AND table_name = 'users'
                 LIMIT 1";
        $users = $this->conn->query($check_users);

        $check_login = "SELECT *
                 FROM information_schema.tables
                 WHERE table_schema = 'mysqldb'
                     AND table_name = 'login_attempts'
                 LIMIT 1";
        $login = $this->conn->query($check_login);

        if (mysqli_num_rows($users) >= 1) {
            $tables = 1;
        }
        if (mysqli_num_rows($login) >= 1) {
            $tables += 1;
        }
        if ($tables === 2) {
            return true;
        } else {
            return false;
        }
    }


    public function bootstrap_tables()
    {
        //create tables
        $msg = ["error" => [], "success" => []];

        if ($this->check_tables === false) {
            array_push($msg["error"], "Tables do not exist.");
            exit;
        }
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

        if ($this->conn->query($user_table)) {
            array_push($msg["success"], "Table 'users' was created successfully! :)");
        } else {
            array_push($msg["error"], "Table 'users' was NOT created successfully :( ");
        }

        if ($this->conn->query($login_table)) {
            array_push($msg["success"], "Table 'login_attempts' was created successfully! :)");
        } else {
            array_push($msg["error"], "Table 'login_attempts' was NOT created successfully :( ");
        }
        return json_encode($msg);
    }
}
