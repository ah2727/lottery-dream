<?php

include_once "../clases/deposit.php";
// Check if the 'crypto' parameter is present in the URL
if (isset($_GET['crypto'])) {
    // Get the 'crypto' parameter from the URL
    $crypto = htmlspecialchars($_GET['crypto']);
}
?>
<div class="d-flex justify-content-center align-items-center my-5">
    <form  method="POST" class="w-100 d-flex justify-content-center">
    <div class="d-flex justify-content-center flex-column gradient-bg shadow-lg p-4 form-size rounded">
        <h3 class="text-center mb-4">Deposit</h3>
        <h6 class="text-center mb-3">
            Selected Crypto: <strong><?php echo $crypto; ?></strong>
        </h6>

        <!-- Email Input -->
        <div class="form-group glassmorphism-input mb-3 shadow-lg">
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <!-- Amount Input -->
        <div class="form-group glassmorphism-input mb-3 shadow-lg">
            <label for="amount">Amount:</label>
            <input id="amount" type="number" name="amount" class="form-control" placeholder="Enter amount" required>
        </div>

        <!-- Select Payment Gateway with Images -->
        <div class="form-group mb-3">
            <label>Select Payment Gateway:</label>
            <div class="payment-options d-flex justify-content-around">
                <label class="payment-option">
                    <input type="radio" name="gateway" value="oxapay" checked>
                    <img src="/image/oxay.svg" alt="Oxapay" class="img-fluid">
                    <p>Oxapay</p>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50 shadow-lg">Submit</button>
        </div>
        </form>
    </div>
</div>

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
}
$dep = new deposit();
$result = $dep->createorder($email,$amount);
?>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
<?php echo $result ?>
        <?php endif; ?>