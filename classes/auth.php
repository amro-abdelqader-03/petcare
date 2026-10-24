<?php
require_once("database.php");

class Auth{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function valid_email($email){
        return $this->db->checkEmail($email);
    }
    public function valid_password($password){
        if(strlen($password) < 8){
            return false;
        }
        return true;
    }
    public function valid_confirm_password($confirm_password, $password){
        if ($confirm_password != $password){
            return false;
        }
        return true;
    }
    public function register($fname, $lname, $email, $password){
        return $this->db->addUser($fname, $lname, $email, $password);
    }

    public function login($email, $password)
    {
        $user = $this->db->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['userID'] = $user['id'];
                return $user;
            }
        }
        return false;
    }
}
?>