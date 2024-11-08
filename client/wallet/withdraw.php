<?php
session_start();
// Check if the 'crypto' parameter is present in the URL

include_once "../../clases/withdrawl.php";
$withdrawl = new withdrawl();
$email = $_SESSION["emailc"];
if (isset($_POST['address'])) {
    $address = htmlspecialchars($_POST['address']);
}
if (isset($_POST['amount'])) {
    // Get the 'crypto' parameter from the URL
    $amount = htmlspecialchars($_POST['amount']);
}
if($address && $amount){
$withdrawl->createwithdraw($email,$amount);

}else{
    $_SESSION["error"]="not success";
}
header(header: "Location:/client/index.php?menu=wallet ");

?>