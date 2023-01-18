<?php

    namespace MyApp;

    use PDO;

    class User {

        public $db;
        public $userID;
        public $sessionID;

        public function __construct() {

            $db = new \MyApp\DB();
            $this->db = $db->connect();
            $this->userID=$this->ID();
            $this->sessionID = $this->getSessionID();

        }

        public function ID() {
            
            if ($this->isLoggedIn()) {

                return $_SESSION['userID'];

            }

        }

        public function getSessionID() {
            return session_id();
        }

        public function emailExists($email) {

            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email`=:email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if (!empty($user)) {
                
                return $user;

            } else {

                return false;

            }

        }

        public function hash($password) {

            return password_hash($password, PASSWORD_DEFAULT);

        }

        public function redirect($location) {

            header("location: " . BASE_URL . $location);

        }

        public function userData ($userID = '') {

            $userID = ((!empty($userID)) ? $userID : $this->userID); // this is short hand if statement
            
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `userID`=:userID");
            $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);

        }

        public function isLoggedIn() {

            return ((isset($_SESSION['userID'])) ? true: false);
            
        }

        public function logout() {
            
            $_SESSION = array();
            session_destroy();
            session_regenerate_id();
            $this->redirect('index.php');

        }

        public function getUser() {

            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `userID` != :userID");
            $stmt->bindParam(":userID", $this->userID, PDO:: PARAM_INT);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($users as $user) {
                
                echo "

                    <li style='margin: 20px 0; width: 100%'>
                        
                        <div style=' display: flex; column-gap: 20px; justify-content: space-between;'>
                            
                            <img src='". BASE_URL . $user->profileImage ."' style='width: 40px; height: 40px; position: relative; top: -15;'>
                            
                            <a href='". BASE_URL . "connect.php?username=" . $user->username ."'> ". $user->username ." </a>
                        
                        </div>

                    </li>

                ";

            }

        }

        public function getUserByUsername ($username) {
           
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `username`=:username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);

        }

        public function updateSession() {

            $stmt = $this->db->prepare("UPDATE `users` SET `sessionID` = :sessionID WHERE `userID` = :userID ");
            $stmt->bindParam(":sessionID", $this->sessionID, PDO::PARAM_STR);
            $stmt->bindParam(":userID", $this->userID, PDO::PARAM_INT);
            $stmt->execute();

        }

        public function getUserBySession($sessionID) {

            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `sessionID`=:sessionID");
            $stmt->bindParam(":sessionID", $sessionID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);

        }

        public function updateConnection($connectionID, $userID) {

            $stmt = $this->db->prepare("UPDATE `users` SET `connectionID` = :connectionID WHERE `userID` = :userID ");
            $stmt->bindParam(":connectionID", $connectionID, PDO::PARAM_STR);
            $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
            $stmt->execute();

        }


    }

?>