<?php
session_start();
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
    if (isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }

    if (isset($_POST['amount'])) {
        $amount = htmlspecialchars($_POST['amount']);
    }
    $dep = new deposit();
    $result = $dep->createorder($email,$amount,$crypto);
    $_SESSION['payid']= $result;
    $pay = new pay();
    $payment = $pay->oxPay($amount,$email,$result,"test");
    print_r($payment);
    header(header: "Location: " . $payment->payLink);

}

?>
