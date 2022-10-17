<?php 

  include "../includes/header/dashboardHeader.php";

    $dbhost = 'server_mongo';
    $dbname = 'vulnweb';
    $username = 'root';
    $password = 'root';

    $mng = new MongoDB\Driver\Manager("mongodb://$username:$password@$dbhost:27017/");

    if (!empty($_GET['id'])){

        $query = new MongoDB\Driver\Query([ "id" => $_GET['id'] ]);

        $rows = $mng->executeQuery("vulnweb.users", $query);
        
        foreach ($rows as $row) {
            echo "<br>";
            echo "ID : ".$row->id. "<br>";
            echo "秘密鍵 : ".$row->password. "<br>";
            echo "<br>";
        }
    }
?>

<div class="col-md-9 personal-info">
  <form class="form-horizontal" role="form" method="get" action="">
    <div class="form-group">
      <label class="col-lg-5 control-label name">IDから秘密鍵を検索:　例(24c9e15e52afc47c225b757e7bee1f9d) </label>
      <input type="text" name="id" placeholder="id" >
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input class="btn btn-primary" value="検索"  type="submit">
        <span></span>
      </div>
    </div>
  </form>
</div>