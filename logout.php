<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data["loginStatus"] === "logout") {
        session_destroy();

        echo json_encode(['success' => 'Successfully logged out']);
        exit();
    }
}
