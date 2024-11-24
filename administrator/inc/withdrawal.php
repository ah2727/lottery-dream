<?php
include_once "../clases/withdrawl.php";

$withdrawalcls = new withdrawl();
$withdrawals = $withdrawalcls->get_all_withdrawal_noneconfirmed();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'confirm_withdrawal') {
    if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['amount'])) {
        $withdrawalId = $_POST['id'];
        $email = $_POST['email'];
        $amount = $_POST['amount'];
        try {
            // Insert the withdrawal confirmation into the table
            $withdrawalcls->insertWithdrawalConfirmation($amount, $email, 1, $withdrawalId);
            echo "Withdrawal ID " . htmlspecialchars($withdrawalId) . " confirmed successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Required data missing.";
    }
    exit; // Stop further execution after handling the AJAX request
}
?>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Email</th>
            <th>Success</th>
            <th>Date/Time</th>
            <th>wallet</th>
            <th>crypto</th>
            <th>confirm</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($withdrawals)): ?>
            <?php foreach ($withdrawals as $withdrawal): 
                $walletdata = $withdrawalcls->getWithdrawalWallet($withdrawal['email']);
                ?>
                <tr>

                    <td><?php echo htmlspecialchars($withdrawal['id']); ?></td>
                    <td><?php echo htmlspecialchars($withdrawal['amount']); ?></td>
                    <td><?php echo htmlspecialchars($withdrawal['type']); ?></td>
                    <td><?php echo htmlspecialchars(string: $withdrawal['email']); ?></td>
                    <td><?php echo htmlspecialchars($withdrawal['success']); ?></td>
                    <td><?php echo htmlspecialchars($withdrawal['datetime']); ?></td>
                    <td><?php echo htmlspecialchars($walletdata["address"] ); ?></td>
                    <td><?php echo htmlspecialchars($walletdata["crypto"] ); ?></td>


                    <td>
                        <button class="confirm-button" onclick="confirmWithdrawal(<?php echo htmlspecialchars($withdrawal['id']); ?>, '<?php echo htmlspecialchars($withdrawal['email']); ?>', <?php echo htmlspecialchars($withdrawal['amount']); ?>)">
                            Confirm
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No withdrawals found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<script>
    function confirmWithdrawal(id, email, amount) {
        // Confirm the action with a dialog box
        if (confirm('Are you sure you want to confirm this withdrawal?')) {
            // Create a new AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost:8000/administrator?type=withdrawal", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Define what happens when the response is received
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Assuming the response is a success message
                    // Optionally, reload the page or update the table dynamically
                    location.reload();

                }
            };

            // Send the request with the withdrawal ID, email, and amount
            xhr.send("action=confirm_withdrawal&id=" + id + "&email=" + encodeURIComponent(email) + "&amount=" + encodeURIComponent(amount));
        }
    }
</script>
