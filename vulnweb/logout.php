<?php

    session_start();

    include "includes/connection.php";
    include "includes/session.php";

    $session = new Session; 
    $session->logOut();

    header('Location: index.php');
    exit();

?>