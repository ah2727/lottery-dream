<?php
include_once 'clases/db_connect.php';
include_once 'clases/register.php';
session_start();
$pdo = new register();
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)){
        header("Location:login.php");
    }else{
        $res = $pdo->login($email);
        if ($res){
            if (password_verify($password,$res['pass'])){
                $_SESSION['emailc'] = $res['email'];
                header("Location:client/index.php");
            }else{
                $_SESSION['error'] = "Email or Password not match";
                header("Location:login.php");
            }
        }else{
            $_SESSION['error'] = "Email or Password not match";
            header("Location:login.php");
        }
    }
}else{
    header("Location:login.php");
}