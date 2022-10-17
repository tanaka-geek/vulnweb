<?php 

  session_start();

  include "includes/connection.php";
  include "includes/session.php";
  include "includes/header/header.php";

  $session = new Session; 
  $session->logIn();

?>

<div class="col-md-9 personal-info">
  <form class="form-horizontal" role="form" method="post" action="">
    <div class="form-group">
      <label class="col-lg-3 control-label name">Username: </label>
      <input type="text" name="username" placeholder="Username" required>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Password: </label>
      <input type="password" name="password" placeholder="Password" required>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input class="btn btn-primary" value="ログイン"  type="submit">
        <span></span>
      </div>
    </div>
  </form>
</div>