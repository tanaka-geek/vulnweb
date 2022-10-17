<?php 

  include "../includes/connection.php";
  include "../includes/session.php";
  include "../includes/header/dashboardHeader.php";

  $session = new Session;
  session_start();
  $session->userRedirect(); 

  $db = Connection::openConnection();

  $user = new User;
  $user->createUser($session->getSessionId());
  $row = $user->getData();

  $username = $row['username'];
  $fullname = $row['fullname'];
  $address = $row['address'];
  $phone = $row['phone'];
  $age = $row['age'];

  if(isset($_POST['fullname']) ||
      isset($_POST['address']) ||
      isset($_POST['phone'])  ||
      isset($_POST['age']))    {

          try{

            $sql = "UPDATE profile SET fullname = :fullname, address = :address, phone = :phone, age = :age WHERE username = :username";
          
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":username",$_SESSION['isLogged'],PDO::PARAM_STR);
            $stmt->bindParam(":fullname",$_POST['fullname'],PDO::PARAM_STR);
            $stmt->bindParam(":address",$_POST['address'],PDO::PARAM_STR);
            $stmt->bindParam(":phone",$_POST['phone'],PDO::PARAM_STR);
            $stmt->bindParam(":age",$_POST['age'],PDO::PARAM_INT);
    
            $stmt->execute();

            echo 'プロフィール変更を保存しました';

          }
          catch (PDOException $e) {
              echo $e->getMessage(); // FOR DEBUGGING
      }
  }

?>

<!-- edit form column -->
<div class="col-md-9 personal-info">
  <h3>ユーザープロフィール</h3>
  <form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
      <label class="col-lg-3 control-label name">Username: <?php echo $username; ?></label>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Name:</label>
      <div class="col-lg-8">
        <input class="form-control" name="fullname" value="<?php echo $fullname; ?>" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Address:</label>
      <div class="col-lg-8">
        <input class="form-control" name="address" value="<?php echo $address; ?>" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Age </label>
      <div class="col-lg-8">
        <input class="form-control" name="age" value="<?php echo $age; ?>" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Phone Number </label>
      <div class="col-lg-8">
        <input class="form-control" name="phone" value="<?php echo $phone; ?>" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="Save" type="button">
        <span></span>
        <input class="btn btn-default" value="キャンセル" type="reset" onclick="window.location.href='/users/profile.php'">
      </div>
    </div>
  </form>
</div>