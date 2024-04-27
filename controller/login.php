<?php 
require 'config.php';

if(isset($_POST['txtCargo'],$_POST['txtPassword'])) {
    $con = new mysqli(s,u,p,bd);
    $query = "SELECT COUNT(*) FROM users WHERE cargo = ? AND password = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $_POST['txtCargo'], $_POST['txtPassword']);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    if($result === 1 && $_POST['txtCargo']==="Supervisor") {
        session_start();
        view("Supervisor");
        exit();
    } 
    else if($result === 1 && $_POST['txtCargo']==="Administrador"){
        session_start();
        view("Admin");
        exit();
    }
    else{
        controller("home");
    }
    $con->close();
} 
?>
