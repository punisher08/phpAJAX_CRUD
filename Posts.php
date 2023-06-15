<?php
session_start();
$auth_user = $_SESSION['user_id'];
include 'includes/functions.php';
// echo '<pre>';
// print_r($auth_user);
// echo '<pre>';
$pdo = new App();
$results = $pdo->get_all_post();
$output = '';
foreach($results as $post){
    $output .= '<div class="col-md-8" >';
    $output .= '<div class="card mt-3">';
        $output .= '<div class="card-header post-header">';
        $output .= '<h4>'.$post->post_title.'</h4>';
        if($auth_user == $post->user_id){
            $output .= '<button class="delete-post" id="delete-post" post-id="'.$post->post_id.'" style="border:none; background:transparent;"><i class="fas fa-trash"></i></button>';
        }
        
        $output .= '</div>';
    $output .= '<div class="card-body">';
        $output .= '<p>'.$post->post_description.'</p><hr>';
    $output .= '</div>';
    $output .= get_comments($pdo,$post->post_id,$post->user_id,$auth_user);
    $output .= '</div>';
    $output .= '<div class="card-footer p-3">';
    $output .= '<span class="author">Author: '.get_author($pdo,$post->user_id).'</span>';
    $output .= '</div>';
    $output .= '</div>';
}
echo $output;

function get_comments($pdo,$post_id,$user_id,$auth_user){
    $query = $pdo->pdo_connect_mysql()->prepare("SELECT * FROM `comments` WHERE post_id = :post_id");
    $query->bindValue(":post_id",$post_id);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $output = '';
    foreach($results as $comment){
        $output .='<div class="comment-group">';
        if($auth_user == $comment->user_id){
            $output .= '<p class="mx-3 comment-msg" style="background: #0aa7af; width: 60%;padding:20px;"><strong>@'.get_commentor($pdo,$comment->user_id).'</strong> '.$comment->msg.'<span id="del-comment" comment-id="'.$comment->comment_id.'" style="float: right;"><i class="fas fa-times-circle"></i></span></p>';
        }else{
            $output .= '<p class="mx-3 comment-msg" style="width: 60%;float: right;"><strong>@'.get_commentor($pdo,$comment->user_id).'</strong> '.$comment->msg.'</p>';
        }
        $output .= '</div>';
    }
    $output .= '<div class="d-flex">';
    $output .= '<button class="btn btn-success" post-id="'.$post_id.'" id="reply" style="width:20%; margin:10px;">comment</button>';
    $output .= '<input type="text" class="form-control" id="comment-post-'.$post_id.'" placeholder="write comment" style="margin:10px; border-radius:25px;">';
    $output .= '</div>';
    return $output;
}
function get_author($pdo,$user_id){
    $query = $pdo->pdo_connect_mysql()->prepare("SELECT * FROM `users` WHERE id = :id");
    $query->bindValue(":id",$user_id);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);

    return $results->username;
}
function get_commentor($pdo,$user_id){
    $query = $pdo->pdo_connect_mysql()->prepare("SELECT * FROM `users` WHERE id = :id");
    $query->bindValue(":id",$user_id);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    return $results->username;
}