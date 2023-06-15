<?php
session_start();
include '../includes/functions.php';
$pdo = new App();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Login</title>
        <link href='../assets/css/style.css' rel='stylesheet' type='text/css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.1/css/all.css'>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    </head>
    <?php
    if(!empty($_GET['response'])):
      $response = $_GET['response'];
      if($response == 'success'){
        ?>
        <script>alert('Successfully registered. Please login');</script>
        <?php
      }
    endif;
    ?>
    <body>
    <div class="content">
      <div class="App">
          <div class="login-card">
            <div class="border-style"></div>
            <form class="login-form" method="post">
              <div class="login-logo">
                <h1 style="font-size:2rem; font-weight:700;">Login</h1>
              </div>
              <div class="input-group">
                <input type="text" name="username" placeholder="Username or email"></input><br />
              </div>
              <div class="input-group">
                <input type="password" name="password" placeholder="Password"></input><br />
              </div>
                  <div class="login-btn-holder">
                    <button type="submit" id="submit" name="login-btn" class="login-btn">Login</button>
                    <a href="register.php"><button type="button" id="register" class="register-btn">Register</button></a>
                  </div>
            </form>
          </div>
        </div>
    </div>
    <script src="../assets/js/app.js"><script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

<?php
if(isset($_POST['login-btn'])){

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $user_id = $pdo->Login($username,$password);   
        $_SESSION['user_id'] = $user_id;
        header("location:../index.php");
}




