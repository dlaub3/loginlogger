<?php
ini_set('display_errors', 'on');
require_once('initialize.php');
require_once('ClassDatabaseActions.php');
require_once('ClassValidation.php');


if (!isset($_POST)) {
    exit;
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $validate = new Validation;
    $options = ["min" => 6, "max" => 15];
    $valid_password = $validate->validate_password($password, $options);
}

if ($valid_password === true) {
    $conn = new DatabaseActions;
    $user = $conn->new_user($email, $password);
} else {
    echo json_encode($valid_password);
}
