<?php
include_once "./clases/deposit.php";
session_start();

if(isset($_GET['trackId'])){
    $trackId = htmlspecialchars($_GET['trackId']);
}
include_once 'clases/Cheak.php';
$tezst = new Cheak();
$rss =  $tezst->CheakPay($trackId);
if ($rss->status == "Paid" || $rss->status == ""){
}
$email= $_SESSION['emailc'];
$payid=    $_SESSION['payid'];
$dep = new deposit();
$dep->inserttransaction($email,$trackId,$payid);
var_dump($rss);