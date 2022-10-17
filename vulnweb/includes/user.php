<?php 

class User {

    private $userData;

    public function createUser($username){
  
        $db = Connection::openConnection();
        $sql = "SELECT * FROM profile WHERE username = :username";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(
            ":username",
            $username,
            PDO::PARAM_STR
        );

        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->userData = $res;
    }

    public function getUsername(){
        return $this->userData['username'];
    }

    public function getData(){
        return $this->userData;
    }
    
}