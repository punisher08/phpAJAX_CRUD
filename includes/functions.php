<?php
/**
 * Main class
 */
Class App{
    
  public function pdo_connect_mysql() {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'post-pdo';
        try {
            return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            exit('Failed to connect to database!');
        }
    }

    public function Login($username,$password){
        try {
            $db = $this->pdo_connect_mysql();
            $query = $db->prepare("SELECT id FROM users WHERE (username=:username OR email=:username) AND password=:password");
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $query->bindParam(":password", $password, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->id;
            } else {
                header("location:login.php?response=nouserfound");
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function Register($id,$username, $email, $password,$created)
    {
        try {
                $db = $this->pdo_connect_mysql();
                $query = $db->prepare("INSERT INTO users(id,username, email, password,created_at) VALUES (:id,:username,:email,:password,:created_at)");
                $query->bindValue(":id", $id);
                $query->bindParam(":username", $username, PDO::PARAM_STR);
                $query->bindParam(":email", $email, PDO::PARAM_STR);
                $enc_password = hash('sha256', $password);
                $query->bindParam(":password", $password, PDO::PARAM_STR);
                $query->bindParam(":created_at", $created);
                $query->execute();
                header("location:login.php?response=success");

            
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function getpost($id){
        try {
            $db = $this->pdo_connect_mysql();
            $query = $db->prepare("SELECT * FROM `posts` WHERE user_id = :id");
            $query->bindValue(":id", $id);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            return $results;
        
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function get_all_post(){
        try {
            $db = $this->pdo_connect_mysql();
            $query = $db->prepare("SELECT * FROM `posts`");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            return $results;
        
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function create_post($user_id,$post_title,$post_descrption){
        try {
            $db = $this->pdo_connect_mysql();
            // $query = $db->prepare("INSERT INTO posts(post_id,user_id, post_title, post_description) VALUES (:post_id,:user_id,:post_title,:post_description)");
            $query = $db->prepare("INSERT INTO posts(post_id,user_id, post_title, post_description) VALUES (?,?,?,?)");
            // $query->bindValue(":post_id", 100);
            // $query->bindValue(":user_id", $user_id);
            // $query->bindValue(":post_title", $post_title,PDO::PARAM_STR);
            // $query->bindValue(":post_description", $post_descrption, PDO::PARAM_STR);
            $query->execute([NULL,$user_id,$post_title,$post_descrption]);
            return  'success';
        }catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function create_comment($user_id,$post_id,$comment){
        try {
            $currentDate = date('Y-m-d H:i:s');
            $db = $this->pdo_connect_mysql();
            $query = $db->prepare("INSERT INTO comments (comment_id,user_id, post_id, msg , commented_on , created_at ) VALUES (:comment_id,:user_id,:post_id,:comment,:commented_on,:created_at)");
            $query->bindValue(":comment_id", NULL);
            $query->bindValue(":user_id", $user_id);
            $query->bindValue(":post_id", $post_id);
            $query->bindValue(":comment", $comment, PDO::PARAM_STR);
            $query->bindValue(":commented_on", $currentDate);
            $query->bindValue(":created_at", $currentDate);
            $query->execute();
            // return 'success';
            return $query;
        }catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function delete_post($post_id){
        try {
            $db = $this->pdo_connect_mysql();
            $query = $db->prepare("DELETE FROM `posts` WHERE post_id = $post_id");
            $query->execute();
            return 'success';
        }catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function delete_comment($comment_id){
        try {
            $db = $this->pdo_connect_mysql();
            $query = $db->prepare("DELETE FROM `comments` WHERE comment_id = $comment_id");
            $query->execute();
            return 'success';
        }catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}