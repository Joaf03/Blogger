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

  $stmt = $db->prepare("SELECT * FROM Posts WHERE userID = :userID ORDER BY created_at DESC");
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
  <h1 id="username">User <?php echo htmlspecialchars($username); ?> posts: </h1>
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
  
  <?php include "../Common_Sections/footer.php" ?>
  <script src="user_posts_page.js"></script>
</body>

</html>