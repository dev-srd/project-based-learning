<?php
require_once 'lib/common.php';

// Connect to the database, run a query, handle errors
$pdo = getPDO();
$stmt = $pdo->query('SELECT id, title, created_at, body FROM post');
if ($stmt === false) {
    throw new Exception('There was a problem running this query.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <?php require 'templates/title.php' ?>

    <!-- looping of article post to reduce redundancy of typing another article post -->
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <h2>Article <?php echo htmlEscape($row['title']) ?> title</h2>
        <div><?php echo $row['created_at'] ?></div>
        <p>A paragraph summarising article <?php echo htmlEscape($row['body']) ?>.</p>
        <p><a href="view-post.php?post_id=<?php echo $row['id'] ?>">Read more...</a></p>
    <?php endwhile ?>
</body>
</html>