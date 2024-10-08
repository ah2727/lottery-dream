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
<div class="d-flex justify-content-center mb-5">
<div class="wallet w-100 h-100 rounded p-3">
<div class="glassmorphism text-center text-white mx-auto">
            <!-- Referral Section -->
            <h5 class="font-weight-bold">Referral</h5>
            <p class="mb-1">All referrals: 0 | Month: 0</p>
            <p class="mb-1">Week: 0 | Day: 0</p>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Referral Commission Section -->
            <h5 class="font-weight-bold">Referral Commission</h5>
            <p class="mb-1">All: $0 | Month: $0</p>
            <p class="mb-1">Week: $0 | Day: $0</p>

            <!-- Persian Text Section -->
            <p class="mt-4 font-weight-bold text-right">اینجا هم لینک رفرال و کدش با قابلیت کپی شدن یا کلیک</p>
        </div>
    </div>
</div>
</div>


