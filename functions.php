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
function get_messages($db, $name)
{
    $sql = "SELECT chatMessages,name,dateSent from messages WHERE name = ?";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
function send_message($db, $name, $message)
{
    $sql = "INSERT INTO messages (name,chatMessage ) VALUES (?,?,?);";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(1, $message, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
