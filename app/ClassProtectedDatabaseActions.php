<?php
require_once('ClassDatabaseActions.php');

class ProtectedDatabaseActions extends DatabaseActions
{
    public function get_login_attempts()
    {
        $sql = "SELECT * FROM login_attempts";
        $result = $this->conn->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }
}
