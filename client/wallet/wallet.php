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
foreach ($resTrak as $key => $trak) {
    $ressss = $chek->CheakPay($trak['trackID']);
    if ($ressss->status == 'Expired') {
        $update->DeleteTrack($ressss->trackId);
    } else if ($ressss->status == 'Paid' || $ressss->status == 'Confirming') {
        $update->UpdateTrack($ressss->trackId);
    }
}
$AllShop = $shop->ReadShop($_SESSION['emailc']);
$Winners = $shop->selWinnerEmail($_SESSION['emailc']);
if (!isset($_SESSION['emailc'])) {
    header("Location:../login");
}
include_once "../clases/db_connect.php";
?>
<div class="d-flex justify-content-center mb-5">
<div class="wallet w-100 h-100 rounded p-3">
    <div class="row justify-content-center">
        <!-- First Item -->
        <div class="col-md-3 d-flex flex-column align-items-center m-3 text-center glassmorphism">
            <img class="wallet-icon" src="../image/bnb-bnb-logo.png" alt="bnb" style="width: 50px; height: 50px;">
            <h4 class="text-light m-2">bnb</h4>
            <p class="text-light m-0">432 $</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-light">withdraw</a>
                <a href="index.php?menu=deposit&crypto=bnb" class="text-light">deposit</a>
            </div>
        </div>

        <!-- Second Item -->
        <div class="col-md-3 d-flex flex-column align-items-center m-3 text-center glassmorphism">
            <img class="wallet-icon" src="../image/bitcoin-btc-logo.png" alt="bitcoin" style="width: 50px; height: 50px;">
            <h4 class="text-light m-2">bitcoin</h4>
            <p class="text-light m-0">123 $</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-light">withdraw</a>
                <a href="index.php?menu=deposit&crypto=bitcoin" class="text-light">deposit</a>
            </div>
        </div>

        <!-- Third Item -->
        <div class="col-md-3 d-flex flex-column align-items-center m-3 text-center glassmorphism">
            <img class="wallet-icon" src="../image/dogecoin-doge-logo.png" alt="dogecoin" style="width: 50px; height: 50px;">
            <h4 class="text-light m-2">dogecoin</h4>
            <p class="text-light m-0">2000 $</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-light">withdraw</a>
                <a href="index.php?menu=deposit&crypto=dogecoin" class="text-light">deposit</a>
            </div>
        </div>

        <!-- Fourth Item -->
        <div class="col-md-4 d-flex flex-column align-items-center m-3 text-center glassmorphism">
            <img class="wallet-icon" src="../image/toncoin-ton-logo.png" alt="ton" style="width: 50px; height: 50px;">
            <h4 class="text-light m-2">ton</h4>
            <p class="text-light m-0">100 $</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-light">withdraw</a>
                <a href="index.php?menu=deposit&crypto=ton"class="text-light">deposit</a>
            </div>
        </div>

        <!-- Fifth Item -->
        <div class="col-md-4 d-flex flex-column align-items-center m-3 text-center glassmorphism">
            <img class="wallet-icon" src="../image/tether-usdt-logo.png" alt="tether" style="width: 50px; height: 50px;">
            <h4 class="text-light m-2">tether</h4>
            <p class="text-light m-0">726 $</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-light">withdraw</a>
                <a href="index.php?menu=deposit&crypto=usdt" class="text-light">deposit</a>
            </div>
        </div>
    </div>
</div>
</div>
