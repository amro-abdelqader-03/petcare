<?php
require_once("database.php");
class Admin{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function isAdmin($id){
        return $this->db->checkAdminUser($id);
    }

    public function totalUsers(){
        return $this->db->countAllUsers();
    }

    public function totalSlots(){
        return $this->db->countAllSlots();
    }

    public function totalAppointments(){
        return $this->db->countAllAppointments();
    }

    public function totalPets(){
        return $this->db->countAllPets();
    }
}
?>