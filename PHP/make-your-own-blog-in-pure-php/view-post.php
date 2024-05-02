<?php
require_once 'lib/common.php';

// get the post id
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
} else {
    // we always have a post id var defined
    $postId = 0;
}

// connect
$pdo = getPDO();
$stmt = $pdo->prepare('SELECT title, created_at, body FROM post WHERE id = :id');
if ($stmt === false) {
    throw new Exception('There was a problem preparing this query');
}
$result = $stmt->execute(array('id' => $postId,));
if ($result === false) {
    throw new Exception('There was a problem running this query');
}
// getting row
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A blog application | <?php echo htmlEscape($row['title'])?></title>
</head>
<body>
    <?php require 'templates/title.php' ?>    

    <h2><?php echo htmlEscape($row['title'])?></h2>
    <div><?php echo $row['created_at'] ?></div>
    <p><?php echo htmlEscape($row['body']) ?></p>
    <p><a href="index.php">Back</a></p>
</body>
</html>