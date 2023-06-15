<?php
include 'includes/functions.php';
$pdo = new App();
$post_id = $_POST['post_id'];
$pdo->delete_post($post_id);
echo json_encode('success');