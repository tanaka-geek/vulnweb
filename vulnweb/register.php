<?php 

  session_start();

  include "includes/connection.php";
  include "includes/session.php";
  include "includes/header/header.php";


  $db = Connection::openConnection();

  if (isset($_POST['username']) && isset($_POST['password'])) {
      
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(!empty($username) && !empty($password)) {

          try {

              $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
              $stmt = $db->prepare($sql);
              $stmt->bindValue(':username', $username);
              $stmt->execute();
              $row = $stmt->fetch();

              if($row['num'] > 0){
                  die('That username is already taken');
              }

              else {

                  $sql = "INSERT INTO users (username, password) VALUES (:username, :password);
                          INSERT INTO profile (username) VALUES (:username)";            
                  $stmt = $db->prepare($sql);
                  $stmt->bindValue(':username', $username);
                  $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
                  $stmt->execute();
                  echo 'Account has been registered';

              }
          } 
          catch (PDOException $e) {
              echo $e->getMessage(); // Debugging
          }
      }
  }

?>

<div class="col-md-9 personal-info">
  <form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
      <label class="col-lg-3 control-label name">Username: </label>
      <input type="text" name="username" placeholder="Username" minlength="4" required>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Password: </label>
      <input type="password" name="password" placeholder="Password" minlength="4" required>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input class="btn btn-primary" value="アカウント登録"  type="submit">
        <span></span>
      </div>
    </div>
  </form>
</div>
