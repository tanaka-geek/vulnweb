<table class="table table-striped">
    <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
<?php /* PHP */

include "../includes/header/DashboardHeader.php";
include "../includes/connection.php";
include "../includes/session.php";

$session = new Session;
session_start();
$session->userRedirect(); 

$sql = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$sql) {
    die('<center><br><h3>Error connecting to servers Database.');
}

if (isset($_GET['username'])) {

    try {

        // if(preg_match('/prob|_|\.|\(\)/i', $_GET['username'])) exit("Char is invalid"); 
        // if(preg_match('/or|and|substr\(|=/i', $_GET['username'])) exit("Char is invalid"); 

        $query = "select * from users where username= '" . $_GET['username'] . "'"; 

        $row = @mysqli_fetch_array(mysqli_query($sql,$query)); 

        if (!empty($row)) {

            $query = $sql->query("SELECT username, fullname, address, phone, age FROM profile WHERE username = '" . $row['username'] ."'");

            while($row = $query->fetch_array()){
    
                echo "<tr>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['fullname']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['age']."</td>";
                echo "</tr>"; }

        } 

        else {
            echo 'That user does not exist';
        }

      }
    catch (Error $e) {
        echo 'Error'; // Debugging
    }
}

/* END PHP */ ?> 

<div class="col-md-9 personal-info fixed-bottom">
    <h4>Search Users</h4>
  <form class="form-horizontal" role="form" method="get" action="">
    <div class="form-group">
      <label class="col-lg-3 control-label">Username</label>
      <div class="col-lg-8">
        <input class="form-control" name="username" type="text" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input type="submit" class="btn btn-primary" value="プロフィール検索" type="button">
      </div>
    </div>
  </form>
</div>