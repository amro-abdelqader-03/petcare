<?php
require_once("config.php");
class Database
{
    private $conn;
    private $pdo;
    public function __construct()
    {
        $this->conn = new Connect();
        $this->pdo = $this->conn->getPdo();
    }

    public function checkEmail($email)
    {
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);

        if (!$stmt) {
            return false;
        }
        if ($stmt->execute([$email])) {
            $result = $stmt->rowCount();
            if ($result > 0) {
                return false;
            }
            return true;
        } else {
            return false;
        }

    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT id, password, role FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$email])) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

    public function addUser($fname, $lname, $email, $password)
    {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fname, lname, email, password) VALUES 
        (?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute([$fname, $lname, $email, $hash_pass]);
        } else {
            return false;
        }
    }
}
?>