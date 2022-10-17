<?php

include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

class Connection{

    public static function openConnection(){
        try{
            $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            return $db;
        }catch (PDOException $e){
            return $e;
        }
    }
}

?>



