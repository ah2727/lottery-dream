<?php
ob_start();
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/Cheak.php';
include_once '../clases/Update_Database.php';
include_once "../clases/referral.php";

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
$referral= new referral();
$referral_id = $referral->getReferralByEmail($_SESSION['emailc']);

?>
<div class="d-flex justify-content-center mb-5">
<div class="bg-light bg-gradient  referral rounded p-3 shadow-lg referral-container">
    <h1 class=" fs-1 d-flex justify-content-center ">referral</h1>
<div class="text-center  mx-auto referral-secrtion pt-5">
            <!-- Referral Section -->
            <p class="mb-1">All referrals: 0 | Month: 0</p>
            <p class="mb-1">Week: 0 | Day: 0</p>

            <!-- Divider -->

            <!-- Referral Commission Section -->
            <h5 class="font-weight-bold">Referral Commission</h5>
            <p class="mb-1">All: $0 | Month: $0</p>
            <p class="mb-1">Week: $0 | Day: $0</p>
<div class="shadow-lg text-center rounded mt-4">
<h1 class=" fs-3 d-flex justify-content-center ">friends</h1>

</div>
        </div>
        <input class="btn btn-primary" type="submit" value="share link" data-bs-toggle="modal" data-bs-target="#sharingmodal">
    </div>

</div>
</div>
<div class="modal fade" id="sharingmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <?php
        echo 'http://localhost:8000/signUp/step1.php?referral=' . $referral_id['referral'];
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">copylink</button>
      </div>
    </div>
  </div>
</div>
