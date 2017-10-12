<?php
ini_set('display_errors', 'on');
require_once('initialize.php');
require_once('ClassDatabaseActions.php');
require_once('ClassAuthentication.php');

if (!isset($_POST)) {
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

//get the user from the databse
$conn = new DatabaseActions;
$user = $conn->get_user_by_email($email);

//login the user
if ($user) {
    $auth = new Authenticate;
    $login = $auth->login($user, $password);
}
