<?php

require_once 'functions.php';
session_start();
$error_message;
$success_message;
$_SESSION["logged_in"] = false;

if (isset($_POST['Submit'])) {
    $username = htmlspecialchars(trim($_POST["user-name"]));
    $password = htmlspecialchars(trim($_POST["user-password"]));

    if (login($conn, $username, $password)) {
        $success_message = "Login successful.";
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
    } else {
        $error_message = "Invalid username or password.";
        $_SESSION["logged_in"] = false;
    }
}





require 'view.php';
