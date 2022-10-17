<table class="table table-striped">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Admin</th>
        </tr>
    </thead>
    <tbody>
<?php /* PHP */

include "../includes/header/adminDashboardHeader.php";
include "../includes/connection.php";
include "../includes/session.php";

$session = new Session;
session_start();

$sql = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$sql) {
    die('<center><br><h3>Error connecting to servers Database.');
}

$query = $sql->query("SELECT * FROM users ORDER by is_admin DESC");

while($row = $query->fetch_array()){
    echo "<tr>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['password']."</td>";
    echo "<td>".$row['is_admin']."</td>";
    echo "</tr>"; }

if (isset($_POST['username']) && isset($_POST['password'])) {

    try {

        $query = $sql->query("UPDATE users SET password = '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "' WHERE username = '" . $_POST['username'] . "'");
        echo "Changed Password...";

      }
    catch (Error $e) {
        echo $e; // Debug
    }
}

/* END PHP */ ?> 


<div class="col-md-9 personal-info fixed-bottom">
    <h4>Change password</h4>
  <form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
      <label class="col-lg-3 control-label">Username</label>
      <div class="col-lg-8">
        <input class="form-control" name="username" type="text" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">New Password</label>
      <div class="col-lg-8">
        <input class="form-control" name="password" type="text" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="Save" type="button">
        <span></span>
        <input class="btn btn-default" value="キャンセル" type="reset">
      </div>
    </div>
  </form>
</div>