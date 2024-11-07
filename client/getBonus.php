<?php
include_once "../clases/referral.php";

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Initialize referral object (if needed)
    $referral = new referral();

    // Get the bonus for the invited user
    $bonus = $referral->getInvitedWalletBonus($email);

    // Return the result as a JSON response
    echo json_encode(['bonus' => $bonus]);
}
?>