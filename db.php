<?php
//Makes DB connection
$servername = "sql1.njit.edu";
$username = "ksl29";
$password = "MrJoestur@69";
$dbname = "ksl29";
$error;

$dsn = 'mysql:host=' . $servername . ';dbname=' . $dbname;
$options = [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

// Create PDO Instance
try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
}
