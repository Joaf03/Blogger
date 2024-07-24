<?php
session_start();

$dbfile = "../Database/mydatabase.db";

try {
    $db = new PDO("sqlite:" . $dbfile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Invalid request method");

    $username = trim($_POST['username']);
    $stmt = $db->prepare("SELECT COUNT(*) FROM Users WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count != 0) {
        assignLoggedUser($db, $username);
    }

    $stmt = $db->prepare("INSERT INTO Users (username) VALUES (:username)");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);

    if (!$stmt->execute()) die("ERROR: Failed while adding a new user");

    assignLoggedUser($db, $username);
} catch (PDOException $e) {
    echo "ERROR- connection failed: " . $e->getMessage();
}
function assignLoggedUser($db, $username)
{
    $stmt = $db->prepare("SELECT userID FROM Users WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["userID"] = $user["userID"];
    $_SESSION["username"] = $username;
    die(header("Location: ../Feed_Page/feed_page.php"));
}
