<?php
// Check if the 'crypto' parameter is present in the URL
if (isset($_GET['crypto'])) {
    // Get the 'crypto' parameter from the URL
    $crypto = htmlspecialchars($_GET['crypto']);
}
?>
<div class="d-flex justify-content-center align-items-center my-5 ">
    <form  method="POST" class="w-100 d-flex justify-content-center">
    <div class="d-flex justify-content-center flex-column gradient-bg shadow-lg p-4 form-size rounded">
        <h3 class="text-center mb-4">withdrawl</h3>
        <h6 class="text-center mb-3">
            Selected Crypto: <strong><?php echo $crypto; ?></strong>
        </h6>

        <!-- Email Input -->
        <div class="form-group glassmorphism-input mb-3 shadow-lg">
            <label for="address">address:</label>
            <input id="address" type="text" name="address" class="form-control" placeholder="Enter your email" required>
        </div>

        <!-- Amount Input -->
        <div class="form-group glassmorphism-input mb-3 shadow-lg">
            <label for="amount">Amount:</label>
            <input id="amount" type="number" name="amount" class="form-control" placeholder="Enter amount" required>
        </div>



        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50">Submit</button>
        </div>
        </form>
    </div>
</div>