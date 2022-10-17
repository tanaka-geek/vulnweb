<?php

    include "../includes/connection.php";
    include "../includes/session.php";
    include "../includes/header/dashboardHeader.php";

    $session = new Session;
    session_start();
    $session->userRedirect(); 

    echo "こんにちわ " . $_SESSION['isLogged'] . 'さん!';

?>

