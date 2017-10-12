<?php
require_once('./TraitLog.php');

class Authenticate
{
    use \Log;

    public function login($user, $password)
    {
        if ($user) {
            if (password_verify($password, $user['hash'])) {
                $this->set_session($user);
                // array_push($this->$msg['success'], "Successful login!");
                //successful login
                $this->log_loggin($user['email'], 1);
            } else {
                // array_push(self::$msg['error'], "Login error!");
                //login failure
                $this->log_loggin($user['email'], 0);
            }
        }
    }

    public function logout_user()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['last_login']);
        return true;
    }

    private function set_session($user)
    {
        session_regenerate_id();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['last_login'] = time();
    }
}
