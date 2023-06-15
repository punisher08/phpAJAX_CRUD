<?php
session_start();
include 'includes/functions.php';
$pdo = new App();
$user_id = $_SESSION['user_id'];
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$result = $pdo->create_comment($user_id,$post_id,$comment);

echo json_encode($result);

