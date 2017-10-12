<?php
session_start();

function logout_user()
{
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['last_login']);
    return true;
}

logout_user();
echo json_encode(["error" => [],"success" => ["You have been logged out."]]);
