<?php


class Authorization
{
    private function is_logged_in()
    {
        return isset($_SESSION['user_id']);
    }

    public function verify_login()
    {
        if (!$this->is_logged_in()) {
            // error
          return false;
        } else {
            // success
          return true;
        }
    }
}
