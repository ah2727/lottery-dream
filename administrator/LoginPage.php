<?php
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/send_Email.php';
$send = new send_Email();
$pdo = new readingData();
session_start();
if (isset($_POST['submit'])){
    if (empty($_POST['Email']) || empty($_POST['password'])){
        $_SESSION['errorMsg'] = 'please Enter All field';
        header("Location:login.php");
    }else{
        $res = $pdo->LoginAdministrator($_POST['Email']);
        $_SESSION['role'] = $res['Role'];
        if ($res){
            $result = password_verify($_POST['password'],$res['Password']);
            if ($result){
                $_SESSION['email'] = $_POST['Email'];
                unset($_SESSION['errorMsg']);
                if ($res['TwoSteps'] == 0){
                    header("Location:index.php");
                }else{
                    $random = rand(10000,999999);
                    $send->ConfirmEmail($_SESSION['email'],$random);
                    $_SESSION['Two'] = $random;
                    header("Location:TwpConfirm.php");
                }
            }else{
                $_SESSION['errorMsg'] = 'password or Email not true';
                header("Location:login.php");
            }
        }else{
            $_SESSION['errorMsg'] = 'password or Email not true';
            header("Location:login.php");
        }
    }
}else{
    header("Location:login.php");
}
