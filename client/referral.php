<?php
ob_start();
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/Cheak.php';
include_once '../clases/Update_Database.php';
$update = new Update_Database();


$shop = new readingData();
$chek = new Cheak();
$resTrak = $shop->SelTrack($_SESSION['emailc']);
foreach ($resTrak as $key => $trak){
   $ressss = $chek->CheakPay($trak['trackID']);
   if ($ressss->status == 'Expired'){
       $update->DeleteTrack($ressss->trackId);
   }else if ($ressss->status == 'Paid' || $ressss->status == 'Confirming'){
       $update->UpdateTrack($ressss->trackId);
   }
}
$AllShop = $shop->ReadShop($_SESSION['emailc']);
$Winners = $shop->selWinnerEmail($_SESSION['emailc']);
if (!isset($_SESSION['emailc'])){
    header("Location:../login");
}
include_once "../clases/db_connect.php";
?>
<h1>referral</h1>

