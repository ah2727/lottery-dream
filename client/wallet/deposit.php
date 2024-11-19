<?php
session_start();
include_once "../../clases/deposit.php";
include_once "../../clases/pay.php";
include_once "../../clases/deposit.php";
include_once "../../clases/gems.php";
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
function getLastPartOfUrl($url) {
    // Parse the URL to ensure it's properly handled
    $parsedUrl = parse_url($url);

    // Get the path and use basename to extract the last part
    return isset($parsedUrl['path']) ? basename($parsedUrl['path']) : null;
}
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
    $gems=new gems();
    $gems->addGemsRefrral($email);
    $dep = new deposit();
    $payment = $pay->oxPay($amount*1.1,$email,$result,"test");
    $trackid = getLastPartOfUrl($payment->payLink);
    $dep->inserttransaction($email,$trackid,$result);
    $_SESSION["payy"]=$payment;
    header(header: "Location: " . "/PaySubmit.php");
    
}

?>
