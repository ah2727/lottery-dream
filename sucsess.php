<?php
include_once "./clases/deposit.php";
session_start();

if(isset($_GET['trackId'])){
    $trackId = htmlspecialchars($_GET['trackId']);
}
if(isset($_GET['success'])){
    $success = htmlspecialchars($_GET['success']);
}
include_once 'clases/Cheak.php';
$tezst = new Cheak();
$rss =  $tezst->CheakPay($trackId);
if ($success == 1){
}
$email= $_SESSION['emailc'];
$payid=  $_SESSION['payid'];
$dep = new deposit();
$dep->inserttransaction($email,$trackId,$payid);
var_dump($rss);
header('Location: /client/index.php?menu=wallet');
