<?php
require_once('initialize.php');
require_once('ClassAuthorization.php');
require_once('ProtectedDatabaseActions');

$authz = new Authorization;
$authorized = $authz->verify_login();
if ($authorized) {
    $protected_actions = new ProtectedDatabaseActions;
    $data = $protected_actions->get_login_attempts();
}

if ($data) {
    echo $data;
} else {
    echo $msg = ["error" => ["You need to login."], "success" => []];
}
