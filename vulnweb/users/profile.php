<?php 

  include "../includes/connection.php";
  include "../includes/session.php";
  include "../includes/header/dashboardHeader.php";

  $session = new Session;
  session_start();
  $session->userRedirect(); 

  $user = new User;
  $user->createUser($session->getSessionId());
  $row = $user->getData();

  $xml = new SimpleXMLElement('<profile/>');
  $profile = $xml;

  foreach ($row as $key => $value) {
    $profile->addChild($key, $value);
  }

  $xml->asXML('profile.xml');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_end_clean();
    header_remove();
    header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename="profile.xml"');
    echo $xml->asXML();
    exit();
  }


  $username = $row['username'];
  $fullname = $row['fullname'];
  $address = $row['address'];
  $phone = $row['phone'];
  $age = $row['age'];

  

?>

<!-- edit form column -->

<div class="col-md-9 personal-info">
  <h3>プロフィール</h3>
  <form class="form-horizontal" role="form">
    <div class="form-group">
      <label class="col-lg-3 control-label name">Username: <?php echo $username; ?></label>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Name: <?php echo $fullname; ?></label>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Address: <?php echo $address; ?></label>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Age: <?php echo $age; ?></label>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-3 control-label">Phone Number: <?php echo $phone; ?></label>
      <div class="col-lg-8">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        <input class="btn btn-primary" onclick="location.href='./profileUpdate.php'" value="プロフィールを変更する" type="button">
        <span></span>
      </div>
    </div>
  </form>
</div>

<form class="form-horizontal" role="form" method="post" action="">
  <div class="form-group">
    <div class="col-md-8">
      <input class="btn btn-primary" value="プロフィールをダウンロード" type="submit">
    </div>
  </div>
</form>
