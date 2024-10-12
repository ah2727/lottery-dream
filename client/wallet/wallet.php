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
<div class="bg-dark  vh-100 rounded p-3 shadow-lg wallet-container">
<h1 class="text-light fs-1 d-flex justify-content-center glassmorphism">wallet</h1>
    <div class="d-flex align-items-center justify-content-center text-center h-50 items-center">
        <h4 class="text-light fs-1 pt-22 portfolio-value">450$</h4>
    </div>
    <div class="tab-navigation">
        <button class="tab-button active" onclick="openTab(event, 'send')">Send</button>
        <button class="tab-button" onclick="openTab(event, 'receive')">Receive</button>
        <button class="tab-button" onclick="openTab(event, 'history')">History</button>
    </div>
    <div id="send" class="tab-content active">
    <form  method="POST" class="w-100 d-flex justify-content-center  d-flex flex-column">
        <!-- Email Input -->
        <div class="form-group  mb-3 shadow-lg">
            <label for="address">address:</label>
            <input id="address" type="text" name="address" class="form-control" placeholder="Enter your email" required>
        </div>

        <!-- Amount Input -->
        <div class="form-group  mb-3 shadow-lg">
            <label for="amount">Amount:</label>
            <input id="amount" type="number" name="amount" class="form-control" placeholder="Enter amount" required>
        </div>
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
    <input type="hidden" id="selectedOption" name="selectedOption" value="">

</div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50">Submit</button>
            </div>
        </form>  
      </div>
    <div id="receive" class="tab-content">
    <form  action="/client/wallet/deposit.php" method="POST" class="w-100 d-flex justify-content-center  d-flex flex-column">
        <!-- Email Input -->
        <div class="form-group  mb-3 shadow-lg">
            <label class="text-light" for="email">Email:</label>
            <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <!-- Amount Input -->
        <div class="form-group  mb-3 shadow-lg">
            <label class="text-light" for="amount">Amount:</label>
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
        <p class="text-light ">This is the History tab content.</p>
    </div>
</div>
</div>
    <!-- Tabs Content -->

</div>
<script>
        function toggleDropdown() {
        var dropdownMenu = document.querySelector('.dropdown-menu-down');
        dropdownMenu.classList.toggle('show');
    }

    // Select an option and display it
    function selectOption(optionText, imgSrc) {
        var dropdownBtn = document.querySelector('.dropdown-menu-down');
        var dropdownText = document.getElementById('dropdownText');

        dropdownText.innerHTML = '<img src="' + imgSrc + '" style="width: 24px; height: 24px; margin-right: 10px; border-radius: 50%;" alt="Selected">' + optionText;
        selectedInput.value = optionText;

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