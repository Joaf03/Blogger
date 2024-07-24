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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogger</title>
</head>

<body>
    <a href="Feed_Page.html">Go back</a>
    <form action="create_post_page.php" method="POST" enctype="multipart/form-data">
        <h1>Create Post</h1>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter the title" /><br /><br />
        <label for="content">Content:</label>
        <input type="text" id="content" name="content" /><br /><br />
        <button id="submitBtn">Post</button>
    </form>
    
    <?php include "../Common_Sections/footer.php" ?>
    <script src="create_post_page.js"></script>
</body>

</html>