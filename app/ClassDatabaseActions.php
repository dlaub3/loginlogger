<?php
require_once('./TraitLog.php');

class DatabaseActions
{
    use \Log;

    public $conn;

    public function __construct()
    {
        //initialize a database connection;
        $this->conn = new mysqli(DB_SERV, DB_USER, DB_PASS, DB_NAME);
    }

    public function get_user_by_email($email)
    {
        // prepare and bind
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $email, $hashed_password);
        $stmt->fetch();
        $stmt->close();
        $data = array(id => $id, email => $email, hash => $hashed_password);
        //check for success and log attempted login
        if (!$data["id"]) {
            $this->log_loggin($email, 0);
            return false;
        } else {
            return $data;
        }
    }

    public function new_user($email, $password)
    {
        // prepare and bind
        $stmt = $this->conn->prepare("INSERT INTO users ( email, hashed_password )
              VALUES (?, ?)");
        $email = $email;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct()
    {
        //close databse connection
        $this->conn->close();
    }
}
