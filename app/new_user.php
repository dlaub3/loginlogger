<?php
ini_set('display_errors', 'on');
require_once('initialize.php');
require_once('ClassDatabaseActions.php');

if (!isset($_POST)) {
    exit;
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

$conn = new DatabaseActions;
$user = $conn->new_user($email, $password);
