<?php
include 'includes/functions.php';
$pdo = new App();
$comment_id = $_POST['comment_id'];
$pdo->delete_comment($comment_id);
echo json_encode('success');