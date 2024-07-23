<?php
session_start();

if (!isset($_SESSION["username"])) die("User not logged in");

$dbfile = "../Database/mydatabase.db";

try {
  $db = new PDO("sqlite:" . $dbfile);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("SELECT * FROM Posts");
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
  <h1>Blogger</h1>
  <h2>Posts</h2>
  <div>
    <?php if (!empty($posts)) :
      foreach ($posts as $post) : ?>
        <div>
          <h1><?php echo htmlspecialchars($post["title"]); ?></h1>
          <p><?php echo htmlspecialchars($post["content"]); ?></p>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No posts found</p>
    <?php endif; ?>
  </div>

  <div>
    <a href="../Feed_Page/feed_page.php">Feed</a>
    <a href="../Create_Post_Page/create_post_page.html">New Post</a>
    <a href="../User_Posts_Page/user_posts_page.php">My Posts</a>
    <a href="../Landing_Page/landing_page.html">Log Out</a>
  </div>
</body>

</html>