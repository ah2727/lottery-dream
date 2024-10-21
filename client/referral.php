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
$friends = $referral->get_friends($_SESSION['emailc']);
print_r($friends);
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

        </div>
        <div class="text-center  mt-4 friends">
<h1 class=" fs-3 d-flex justify-content-center ">friends</h1>

<table border="1" class="table d-grid" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
    <th scope="col">friendmail</th>
    </tr>
    </thead>
    <tbody id="transactionTableBody">
    </tbody>
    </table>
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
      <p id="referralLink"><?php echo 'http://localhost:8000/signUp/step1.php?referral=' . $referral_id['referral']; ?></p>
      <input type="text" id="hiddenReferralLink" value="<?php echo 'http://localhost:8000/signUp/step1.php?referral=' . $referral_id['referral']; ?>" readonly style="position:absolute; left:-9999px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button onclick="copyReferralLink()" type="button" class="btn btn-primary">copylink</button>
      </div>
    </div>
  </div>
</div>
<script>
  const friends = <?= json_encode($friends); ?>;
  let currentPage = 1;
const rowsPerPage = 3;
const totalPages = Math.ceil(friends.length / rowsPerPage);

// Function to display Freinds on the table
function displayFreinds(page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedFreinds = friends.slice(start, end);

    const tableBody = document.getElementById('transactionTableBody');
    tableBody.innerHTML = '';

    paginatedFreinds.forEach(transaction => {
        const row = `<tr>
            <td>${transaction.inviteremail}</td>


        </tr>`;
        tableBody.insertAdjacentHTML('beforeend', row);
    });
}

// Function to create pagination controls
function setupPagination() {
    const paginationControls = document.getElementById('paginationControls');
    paginationControls.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
        const pageItem = `<li class="page-item ${i === currentPage ? 'active' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>
        </li>`;
        paginationControls.insertAdjacentHTML('beforeend', pageItem);
    }
}

// Function to handle page changes
function goToPage(page) {
    currentPage = page;
    displayFreinds(currentPage);
    setupPagination();
}

// Initialize the table and pagination on page load
document.addEventListener('DOMContentLoaded', () => {
    displayFreinds(currentPage);
    setupPagination();
});
    function copyReferralLink() {
        // Get the hidden input field containing the referral link
        var copyText = document.getElementById("hiddenReferralLink");

        // Select the input field's text
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to clipboard
        document.execCommand("copy");

        // Optionally, alert the user that the link was copied
    }
</script>