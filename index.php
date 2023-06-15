<?php
session_start();
if(empty($_SESSION['user_id'])){ 
    header("location:actions/login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>PDO</title>
        <link href='assets/css/style.css' rel='stylesheet' type='text/css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.1/css/all.css'>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    </head>
    <body>
        <nav class='navtop'>
            <div>
                <h1>LOGO</h1>
                <a href='#' id="create-posts"><i class='fas fa-plus-circle'></i>Create Posts</a>
                <a href='actions/logout.php'><i class='fas fa-user-circle'></i>Logout</a>
            </div>
        </nav>
        <section class="content" id="post-modal" style="display:none;">
            <div class="row justify-content-center">
                <div class="card col-md-8" style="padding:0px;">
                    <div class="card-header">
                        <h4>Create Post</h4>
                    </div>
                    <div class="card-body">
                       <form action="" id="posts-modal-form" method="post">
                           <input type="text" class="form-control" name="user_id" id="userid" value="<?=$_SESSION['user_id']?>" hidden><br />
                           <input type="text" class="form-control" name="post_title" placeholder="Post Title" id="post-title" required><br />
                           <textarea rows="5" class="form-control" name="post_description" placeholder="description" id="post-description" required></textarea><br />
                           <button class="btn btn-warning" id="close-post-modal">Close</button>
                           <input type="submit" value="Post" id="submit" class="btn btn-success">
                       </form>
                    </div>
            </div>
        </section>
        <section class="content mb-5">
            <div class="row justify-content-center" id="posts-results">
                <!-- POSTS DISPLAY HERE -->
            </div>
        </section>
        <script src="assets/js/app.js"><script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>