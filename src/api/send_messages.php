<?php
require '../models/functions.php';
$data = json_decode(file_get_contents('php://input'), true);
$res = [];
$username = htmlspecialchars($data["name"]);
$message = htmlspecialchars($data["message"]);
$recipient = htmlspecialchars($data["recipient"]);
if (send_message($conn, $username, $message, $recipient)) {
    $res['success'] = true;
} else {
    $res['success'] = false;
    $res['error'] = "Sending message failed";
};

echo json_encode($res);
