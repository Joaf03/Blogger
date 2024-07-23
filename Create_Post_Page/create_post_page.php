<?php
session_start();

if (!isset($_SESSION["userID"])) die("User not logged in");

$dbfile = "../Database/mydatabase.db";

try {
    $db = new PDO("sqlite:" . $dbfile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = $_SESSION["userID"];
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $stmt = $db->prepare("INSERT INTO Posts (userID, title, content) VALUES (:userID, :title, :content)");
        $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: ../User_Posts_Page/user_posts_page.php");
            die();
        } else echo "ERROR: Failed while adding a new post";
    }
} catch (PDOException $e) {
    echo "Error- connection failed: " . $e->getMessage();
}
