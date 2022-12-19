<?php
//Makes DB connection
$config = require '../config/database.php';
$servername = "sql1.njit.edu";
$username = "ksl29";
$password = "MrJoestur@69";
$dbname = "ksl29";
$error;

$dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'];

// Create PDO Instance
try {
    $conn = new PDO($dsn, $config['database']['username'], $config['database']['password'], $config['database']['password']);
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
