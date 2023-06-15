<?php
include 'includes/functions.php';
$pdo = new App();
$user_id = $_POST['user_id'];
$post_title = $_POST['post_title'];
$post_description = $_POST['post_description'];
// echo '<pre>';
// print_r($_POST);
// echo '<pre>';
// die();
$result = $pdo->create_post($user_id,$post_title,$post_description);

echo json_encode($result );