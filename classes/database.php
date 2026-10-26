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

    public function checkAdminUser($user_id)
    {
        $sql = "SELECT id, role FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        if (!$stmt) {
            return false;
        }

        if ($stmt->execute([$user_id])) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $user["role"] === "admin") {
                return true;
            }
        }

        return false;
    }

    public function countAllUsers()
    {
        $sql = "SELECT COUNT(*) FROM users WHERE status = 'active' AND role = 'user'";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            return 0;
        }
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
        return 0;

    }

    public function countAllSlots()
    {
        $sql = "SELECT COUNT(*) FROM slots";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            return 0;
        }
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
        return 0;

    }

    public function countAllAppointments()
    {
        $sql = "SELECT COUNT(*) FROM appointments";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            return 0;
        }
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
        return 0;

    }

    public function countAllPets()
    {
        $sql = "SELECT COUNT(*) FROM pets";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            return 0;
        }
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
        return 0;

    }

    public function addSlot($fromDate, $toDate, $date)
    {
        $sql = "INSERT INTO slots (fromDate, toDate, date) VALUES 
        (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute([$fromDate, $toDate, $date]);
        } else {
            return false;
        }
    }

    public function editSlot($id, $fromDate, $toDate, $date)
    {
        $sql = "UPDATE slots SET fromDate = ?, toDate = ?, date = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute([$fromDate, $toDate, $date, $id]);
        }
        return false;
    }

    public function deleteSlot($id)
    {
        $sql = "DELETE FROM slots WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute([$id]);
        }
        return false;
    }

    public function getAllSlots()
    {
        $sql = "SELECT id, fromDate, toDate, date, status FROM slots ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

    public function getAllOpenSlots()
    {
        $sql = "SELECT id, fromDate, toDate, date, status FROM slots WHERE status = 'open' ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

    public function addAppointments($description, $user_id, $slot_id)
    {
        $sql = "INSERT INTO appointments (description, user_id, slot_id) VALUES 
        (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute([$description, $user_id, $slot_id]);
        } else {
            return false;
        }
    }
}
?>