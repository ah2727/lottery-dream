<?php
ob_start();
include_once '../clases/db_connect.php';
include_once '../clases/readingData.php';
include_once '../clases/Cheak.php';
include_once '../clases/Update_Database.php';
include_once '../clases/wallet.php';
include_once "../clases/db_connect.php";
include_once "../clases/withdrawl.php";

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


// wallet amount get
$wallet = new wallet();
$amount = $wallet->get_amount($_SESSION["emailc"]);

// withdrawl wallet
$withdrawl = new withdrawl();
$withdrawl_wallet= $withdrawl->get_wallet($_SESSION['emailc']);
print_r($withdrawl_wallet);

?>
<div class="d-flex justify-content-center mb-5">
<div class="bg-light bg-gradient  vh-100 rounded p-3 shadow-lg wallet-container">
<h1 class=" fs-1 d-flex justify-content-center ">wallet</h1>
    <div class="d-flex align-items-center justify-content-center text-center h-50 items-center">
        <h4 class=" fs-1 pt-22 portfolio-value"><?php echo $amount ?>$</h4>
    </div>
    <div class="tab-navigation">
        <button class="tab-button active" onclick="openTab(event, 'send')">whitdraw</button>
        <button class="tab-button" onclick="openTab(event, 'receive')">deposit</button>
        <button class="tab-button" onclick="openTab(event, 'history')">History</button>
    </div>
    <div id="send" class="tab-content active">
    <form  method="POST" action="" class="w-100 d-flex justify-content-center  d-flex flex-column">
        <!-- Email Input -->

        <!-- Amount Input -->
        <label for="amount">Amount:</label>
        <div class="form-group  mb-3 shadow-lg">
            <input id="amount" type="number" name="amount" class="form-control" placeholder="Enter amount" required>
        </div>
        <label for="amount">address:</label>
        <div class="form-group d-flex mb-3 shadow-lg">
            <?php if (!$withdrawl_wallet): ?>
                <input id="amount" type="number" name="amount" class="form-control" placeholder="Enter amount" readonly>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addaddress">Add</button>
                <?php endif; ?>
                <?php if ($withdrawl_wallet): ?>
                    <input id="amount" type="text" name="amount" value="<?= isset($withdrawl_wallet["address"]) ? $withdrawl_wallet["address"] : ''; ?>" class="form-control" placeholder="Enter amount" readonly>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#editaddress" >edit</button>
                <?php endif; ?>
        </div>


        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50">Submit</button>
            </div>
        </form>  
      </div>
    <div id="receive" class="tab-content">
    <form  action="/client/wallet/deposit.php" method="POST" class="w-100 d-flex justify-content-center  d-flex flex-column">
        <div class="form-group  mb-3 shadow-lg">
            <label  for="amount">Amount:</label>
            <input id="amount" type="number" name="amount" class="form-control" placeholder="Enter amount" required>
        </div>

        <!-- Select Payment Gateway with Images -->

        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50 mt-10 shadow-lg">Submit</button>
        </div>
        </form>
        </div>
    <div id="history" class="tab-content">
        <p ">This is the History tab content.</p>
    </div>
</div>
</div>
<?php if (!$withdrawl_wallet): ?>
    <div class="modal fade" id="addaddress" tabindex="-1" aria-labelledby="addaddressLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addaddressLabel">add address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/client/wallet/withdrawwallet.php" method="POST">
          <div class="mb-3">
            <label for="address" class="col-form-label">address:</label>
            <input type="text" class="form-control" name="address" id="address">
          </div>
          <div class="mb-3">
          <div class="custom-dropdown">
    <!-- The button for the dropdown -->
    <div class="dropdown-btn" id="dropdownBtn" onclick="toggleDropdown()">
    <span id="dropdownText">Select Option</span>
    <span>&#9660;</span> <!-- Down arrow icon -->
    </div>

    <!-- Dropdown menu -->
    <div class="dropdown-menu-down">
        <div class="dropdown-option" onclick="selectOption('bnb', '/image/bnb-bnb-logo.png')">
            <img src="/image/bnb-bnb-logo.png" alt="Option 1">
            bnb
        </div>
        <div class="dropdown-option" onclick="selectOption('dogecoin', '/image/dogecoin-doge-logo.png')">
            <img src="/image/dogecoin-doge-logo.png" alt="Option 2">
            dogecoin
        </div>
        <div class="dropdown-option" onclick="selectOption('bitcoin', '/image/bitcoin-btc-logo.png')">
            <img src="/image/bitcoin-btc-logo.png" alt="Option 3">
            bitcoin
        </div>
        <div class="dropdown-option" onclick="selectOption('tether', '/image/tether-usdt-logo.png')">
            <img src="/image/tether-usdt-logo.png" alt="Option 3">
            tether
        </div>
        <div class="dropdown-option" onclick="selectOption('toncoin', '/image/toncoin-ton-logo.png')">
            <img src="/image/toncoin-ton-logo.png" alt="Option 3">
            toncoin
        </div>
    </div>
    <input type="hidden" id="crypto" name="crypto" value="">

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            <button type="submit" class="btn btn-primary" >Add</button>
        </form>
      </div>

    </div>
  </div>
</div>
                <?php endif; ?>
                <?php if ($withdrawl_wallet): ?>
                    <div class="modal fade" id="editaddress" tabindex="-1" aria-labelledby="editaddressLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input id="amount" type="text" name="amount" value="<?= isset($withdrawl_wallet["address"]) ? $withdrawl_wallet["address"] : ''; ?>" class="form-control" placeholder="Enter amount" readonly>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                <?php endif; ?>


<script>
        function toggleDropdown() {
        var dropdownMenu = document.querySelector('.dropdown-menu-down');
        dropdownMenu.classList.toggle('show');
    }

    // Select an option and display it
    function selectOption(optionText, imgSrc) {
        var dropdownBtn = document.querySelector('.dropdown-menu-down');
        var dropdownText = document.getElementById('dropdownText');
        var dropdownInput = document.getElementById('crypto');


        dropdownText.innerHTML = '<img src="' + imgSrc + '" style="width: 24px; height: 24px; margin-right: 10px; border-radius: 50%;" alt="Selected">' + optionText;
        dropdownInput.value =optionText
        // Close the dropdown
        toggleDropdown();
    }

    // Close the dropdown if clicked outside
    document.addEventListener('click', function(event) {
        var dropdown = document.querySelector('.custom-dropdown');
        var dropdownMenu = document.querySelector('.dropdown-menu-down');
        
        // Check if the clicked target is inside the dropdown, if not, close the dropdown
        if (!dropdown.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }})
    // Function to switch between tabs
    function openTab(evt, tabName) {
        // Get all elements with class="tab-content" and hide them
        var tabContent = document.getElementsByClassName("tab-content");
        for (var i = 0; i < tabContent.length; i++) {
            tabContent[i].classList.remove("active");
        }

        // Get all elements with class="tab-button" and remove the class "active"
        var tabButtons = document.getElementsByClassName("tab-button");
        for (var i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove("active");
        }

        // Show the current tab and add an "active" class to the button that opened the tab
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    // By default, the first tab is active
</script>