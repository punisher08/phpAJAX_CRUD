<?php
include '../includes/functions.php';
$pdo = new App();
if(!empty($_GET['response'])){
  echo '<div class"success-registration">User already exist</div>';
}
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
    <body>
      <div class="content">
        <div class="App">
            <div class="login-card">
              <div class="border-style"></div>
              <form class="login-form" method="post" action="register.php">
                <div class="login-logo">
                <h1 style="font-size:2rem; font-weight:700;">Register</h1>
                </div>
                <div class="input-group">
                  <input type="email" name="email" placeholder="Email"></input><br />
                </div>
                <div class="input-group">
                  <input type="text" name="username" placeholder="Username"></input><br />
                </div>
                <div class="input-group">
                  <input type="password" name="password" placeholder="Password"></input><br />
              
                </div>
                    <div class="login-btn-holder">
                      <a href="register.php"><button type="submit" id="register" class="register-btn" name="register-user">Register</button></a>
                      <a href="login.php" style="text-align:center;">Already have an account?</a>
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
if(isset($_POST['register-user'])){

    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    if($username != '' && $email != '' && $password != ''){
      $registered = $pdo->Register($id,$username, $email, $password,$created);
    }else{
      die('please fill  out the form');
    }
      
    
}






