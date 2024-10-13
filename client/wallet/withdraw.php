<?php
session_start();
// Check if the 'crypto' parameter is present in the URL
if (isset($_GET['crypto'])) {
    // Get the 'crypto' parameter from the URL
    $crypto = htmlspecialchars($_GET['crypto']);
}
include_once "../clases/withdrawl.php"
?>
<div class="d-flex justify-content-center align-items-center my-5 ">

    </div>
</div>
<?php 
$withdrawl = new withdrawl();
$email = $_SESSION["emailc"];
if (isset($_POST['crypto'])) {
    $address = htmlspecialchars($_POST['crypto']);
}
if (isset($_POST['address'])) {
    $address = htmlspecialchars($_POST['address']);
}
if (isset($_POST['amount'])) {
    // Get the 'crypto' parameter from the URL
    $amount = htmlspecialchars($_POST['amount']);
}
$withdrawl->insertwithdrawl($address,$email,$amount,$crypto)
?>