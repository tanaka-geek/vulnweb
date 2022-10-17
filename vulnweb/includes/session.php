<?php 

include "user.php";


class Session{

    private $session;

    public function logUser($username) {
        $_SESSION['isLogged'] = $username; 
    }

    public function logAdmin() {
        $_SESSION['isAdmin'] = TRUE; 
    }

    public function relogUser($username){
        $_SESSION['isLogged'] = $username;
    }

    public function isLogged(){
        if(isset($_SESSION['isLogged'])) {
            return true;
        }
        // else
    }

    public function logIn() {

        // if ($this->isLogged() == true){
        //     $this->logOut();
        // }

        if (isset($_POST['username']) && isset($_POST['password'])) {
    
            $db = Connection::openConnection();

            $username = $_POST['username'];
            $password = $_POST['password'];
        
            if(!empty($username) && !empty($password)) {
        
                $sql = "SELECT * FROM users WHERE username = :username";
                $stmt = $db->prepare($sql);
        
                $stmt->bindParam(
                    ":username",
                    $username,
                    PDO::PARAM_STR
                );
        
                $stmt->execute();
                $res = $stmt->fetch();
        
                if($res) {

                    $verification = password_verify($password, $res['password']);
        
                    if ($verification && $res['is_admin'] == FALSE) {
                        $this->logUser($username);
                        header('Location: /users/dashboard.php');
                        exit();
                    }

                    else if ($verification && $res['is_admin'] == TRUE) {
                        $this->logAdmin();
                        header('Location: /admin/dashboard.php');
                        exit();
                    }
        
                    else {
                        echo('Password is Wrong');
                    }
                    
                }else{
                    echo('Username does not exist');
                }
            }
        }
    } 

    public function logOut(){
        session_destroy();
    }

    public function getSessionId(){
        return $_SESSION['isLogged'];
    }

    public function userRedirect($arg1 = null){

        $arg1 = $arg1? $arg1: "/index.php";

        if (!isset($_SESSION['isLogged'])) {
            header('Location: '. $arg1);
            exit();
        }
    }

}