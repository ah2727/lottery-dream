<?php
ob_start();
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/Cheak.php';
include_once '../clases/Update_Database.php';
include_once "../clases/referral.php";
include_once '../clases/gems.php';
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
$periodsumasmount = $referral->getTransactionSumsByPeriod($_SESSION["emailc"]);
$periodsumreferral = $referral->getReferralSumsByPeriod($_SESSION["emailc"]);
$gems = new gems();
$gemscount= $gems->getGems($_SESSION['emailc']);

?>
<div class="d-flex justify-content-center mb-5">
<div class="bg-light bg-gradient  referral rounded p-3 shadow-lg referral-container">
    <h1 class=" fs-1 d-flex justify-content-center ">referral</h1>
<div class="text-center  mx-auto referral-secrtion pt-5">
            <!-- Referral Section -->
            <p class="mb-1">All referrals: <?php echo $periodsumreferral["all"] ?> | Month: <?php echo $periodsumreferral["month"] ?></p>
            <p class="mb-1">Week: <?php echo $periodsumreferral["week"] ?> | Day: <?php echo $periodsumreferral["day"] ?></p>

            <!-- Divider -->

            <!-- Referral Commission Section -->
            <h5 class="font-weight-bold">Referral Commission</h5>
            <p class="mb-1">All: $<?php echo $periodsumasmount["all"]?> | Month: $<?php echo $periodsumasmount["month"] ?></p>
            <p class="mb-1">Week: $<?php echo $periodsumasmount["week"]?>  | Day: $<?php echo $periodsumasmount["day"]?> </p>
            <p class="mb-1">gems:<?php echo $gemscount ?></p>

        </div>
        <div class="text-center  mt-5 friends">
<h1 class=" fs-3 d-flex justify-content-center ">friends</h1>

<table border="1" class="table table-bordered" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
    <th scope="col"></th>

    <th scope="col">friendmail</th>
    <th scope="col">bonus</th>
    </tr>
    </thead>
    <tbody id="transactionTableBody">
    </tbody>
    </table>
    <nav class="d-flex justify-content-center"><ul class="pagination" id="paginationControls"></ul></nav>
    <div class="modal-body">
      <p id="referralLink"><?php echo 'http://localhost:8000/signUp/step1.php?referral=' . $referral_id['referral']; ?></p>
      <input type="text" id="hiddenReferralLink" value="<?php echo 'http://localhost:8000/signUp/step1.php?referral=' . $referral_id['referral']; ?>" readonly style="position:absolute; left:-9999px;">
      </div>
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
function displayFriends(page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedFriends = friends.slice(start, end);

    const tableBody = document.getElementById('transactionTableBody');
    tableBody.innerHTML = '';
    let index = 1; // Start an index counter for each page

    const bonusData = [];  // Array to store friend and bonus information

    // Fetch bonus data for each friend in paginatedFriends
    Promise.all(
        paginatedFriends.map((friend) =>
            fetch(`/client/getBonus.php?email=${encodeURIComponent(friend.invitedemail)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    bonusData.push({
                        index: index++,  // Increment the index for each friend
                        invitedemail: friend.invitedemail,
                        bonus: data.bonus
                    });
                })
                .catch(error => {
                    console.error('Error fetching wallet bonus:', error);
                    bonusData.push({
                        index: index++,  // Increment the index even in case of error
                        invitedemail: friend.invitedemail,
                        bonus: "Error retrieving bonus"
                    });
                })
        )
    ).then(() => {
        // Sort the bonusData array by bonus value (errors treated as 0 for sorting)
        bonusData.sort((a, b) => {
            const bonusA = isNaN(a.bonus) ? 0 : a.bonus;
            const bonusB = isNaN(b.bonus) ? 0 : b.bonus;
            return bonusB - bonusA;  // Sort in descending order
        });

        // Render sorted data into the table
        bonusData.forEach(rowData => {
            const row = `<tr>
                <td>${rowData.index}</td>
                <td>${rowData.invitedemail}</td>
                <td>${rowData.bonus}</td>
            </tr>`;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
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
    displayFriends(currentPage);
    setupPagination();
}

// Initialize the table and pagination on page load
document.addEventListener('DOMContentLoaded', () => {
    displayFriends(currentPage);
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