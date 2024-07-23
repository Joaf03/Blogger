<?php
session_start();

$username = $_SESSION["username"] ?? "Guest";
$userID = $_SESSION["userID"] ?? "Invalid user";

$posts = [];
$dbfile = "../Database/mydatabase.db";

try {
  $db = new PDO("sqlite:" . $dbfile);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($userID === "Invalid user") die("ERROR: Invalid user ID");

  $stmt = $db->prepare("SELECT * FROM Posts WHERE userID = :userID");
  $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "ERROR- connection failed: " . $e->getMessage();
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
  <h1 id="username">User <? echo htmlspecialchars($username); ?> posts: </h1>
  <div>
    <?php if (!empty($posts)) :
      foreach ($posts as $post) : ?>
        <div>
          <h2> <?php echo htmlspecialchars($post["title"]); ?> </h2>
          <p> <?php echo htmlspecialchars($post["content"]); ?> </p>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No posts found</p>
    <?php endif ?>
  </div>
  <div>
    <a href="../Feed_Page/feed_page.php">Feed</a>
    <a href="../Create_Post_Page/create_post_page.html">New Post</a>
    <a href="../User_Posts_Page/user_posts_page.php">My Posts</a>
    <a href="../Landing_Page/landing_page.html">Log Out</a>
  </div>
  <script src="user_posts_page.js"></script>
</body>

</html>