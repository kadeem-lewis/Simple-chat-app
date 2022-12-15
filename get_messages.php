<?php
require 'functions.php';

// Gets all the messages in the database and converts them to a JSON object
$data = [];
$rows = get_messages($conn);
foreach ($rows as $row) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
