<?php

    include "../includes/connection.php";
    include "../includes/session.php";
    include "../includes/header/dashboardHeader.php"; 

    $session = new Session;
    session_start();
    $session->userRedirect(); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $doc = new DOMDocument();
        $doc->substituteEntities = true;     
        $doc->load($_FILES['time']['tmp_name']);
        $time = $doc->getElementsByTagName('time')->item(0)->textContent;

        echo '以下の時間で登録しました<br>';
        echo '勤務時間: ' . htmlspecialchars($time) .'<br>';
    }

?>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="time" />
<input type="submit"/>
</form>


<body>



