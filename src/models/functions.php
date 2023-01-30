<?php
require 'db.php';


function login($db, $name, $password)
{
    $sql = "SELECT COUNT(*) FROM senders WHERE name = ? AND password = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        return true;
    } else {
        return false;
    }
}
function get_users($db)
{
    $sql = "SELECT name FROM senders";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}
function get_messages($db)
{
    $sql = "SELECT `name`,chatMessage,dateSent,recipient  FROM messages";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function send_message($db, $name, $message, $recipient)
{
    $sql = "INSERT INTO messages (name,chatMessage, recipient ) VALUES (?,?,?);";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $message, PDO::PARAM_STR);
        $stmt->bindValue(3, $recipient, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
