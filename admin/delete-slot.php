<?php
require_once("../classes/admin.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $admin = new Admin();
    if($admin->removeSlote( $id)) {
        header("location: slots.php");
        exit();
    }else{
        echo "<p>Something wrong</p>";
    }
}
?>