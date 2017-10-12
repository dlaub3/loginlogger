<?php
require_once('initialize.php');
require_once('ClassAuthentication.php');

$auth = new Authenticate;
$logout = $auth->logout_user();

if ($logout) {
    echo json_encode(["error" => [],"success" => ["You have been logged out."]]);
}
