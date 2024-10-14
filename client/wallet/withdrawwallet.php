<?php
session_start();
// Check if the 'crypto' parameter is present in the URL

include_once "../../clases/withdrawl.php"
?>
<div class="d-flex justify-content-center align-items-center my-5 ">

    </div>
</div>
<?php 
$withdrawl = new withdrawl();
$email = $_SESSION["emailc"];
if (isset($_POST['address'])) {
    $address = htmlspecialchars($_POST['address']);
}
if (isset($_POST['crypto'])) {
    // Get the 'crypto' parameter from the URL
    $crypto = htmlspecialchars($_POST['crypto']);
}
$withdrawl->insertwithdrawwallet($address,$email,$crypto);
header(header: "Location:/client/index.php?menu=wallet ");

?>