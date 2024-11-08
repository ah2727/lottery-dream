<?php
include_once "../../clases/deposit.php";
include_once "../../clases/pay.php";

use payment\pay;

// Check if the 'crypto' parameter is present in the URL
if (isset($_GET['crypto'])) {
    // Get the 'crypto' parameter from the URL
    $crypto = htmlspecialchars($_GET['crypto']);
    switch($crypto){
    case 'bnb':
        $currency = 'BNB';
        break;

    case 'bitcoin':
        $currency = 'BTC';
        break;

    case 'dogecoin':
        $currency = 'DOGE';
        $description = 'Deposit with Oxapay';
        break;

    case 'ton':
        $currency = 'TON';
        break;

    
    case 'usdt':
        $currency = 'USDT';
        break;
    }
}
?>


<?php
$email = $amount = "";

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize email and amount from POST data
    if (isset($_SESSION['emailc'])) {
        $email = htmlspecialchars($_SESSION['emailc']);
    }

    if (isset($_POST['amount'])) {
        $amount = htmlspecialchars($_POST['amount']);
    }
    $dep = new deposit();
    $result = $dep->createorder($email,$amount*1.1);
    $_SESSION['payid']= $result;
    $pay = new pay();
    $payment = $pay->oxPay($amount*1.1,$email,$result,"test");
    $_SESSION["payy"]=$payment;
    header(header: "Location: " . "/PaySubmit.php");

}

?>
