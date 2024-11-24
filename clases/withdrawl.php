<?php
require_once 'db_connect.php';

class withdrawl extends db_connect
{
    public function createwithdraw($email, $amount)
    {

        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');

        // Use the PDO connection
        $pdo = $this->connect();

        // Step 1: Check wallet balance
        $stmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
        $stmt->execute([$email]);
        $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if wallet exists and if the balance is sufficient
        if ($wallet && $wallet['amount'] >= $amount) {

            // Step 2: Execute the withdrawal if balance is sufficient
            $stmt = $pdo->prepare("INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$amount, "withdraw", $email, "lottery", $currentDateTime]);

            // Get the last inserted ID for the transaction
            $transactionId = $pdo->lastInsertId();

            // Step 3: Deduct the amount from the wallet
            $stmt = $pdo->prepare("UPDATE wallet SET amount = amount - ? WHERE email = ?");
            $stmt->execute([$amount, $email]);
            $_SESSION["success"] = "success";
            return $transactionId; // Return the transaction ID for reference
        } else {
            // Set an error message in the session if the balance is insufficient
            $_SESSION['error'] = "Insufficient balance in wallet.";
            return false; // Return false to indicate failure
        }
    }
    public function insertwithdrawwallet($address, $email, $crypto)
    {
        $currentDateTime = date(format: 'Y-m-d H:i:s');

        $pdo = $this->connect();
        $stmt = $pdo->prepare(query: "INSERT INTO withdrawwallet (crypto, address, email, timechanged) VALUES (?, ?, ?, ?)");
        $stmt->execute([$crypto, $address, $email, $currentDateTime]);
    }
    public function get_wallet($email)
    {
        try {
            // Connect to the database
            $pdo = $this->connect();

            // Trim and prepare the email
            $email = trim($email);

            // Prepare the SQL statement
            $stmt = $pdo->prepare("
                SELECT *
                FROM withdrawwallet
                WHERE LOWER(email) = LOWER(:email)
                ORDER BY timechanged DESC
                LIMIT 1
            ");

            // Bind the email parameter
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if a wallet was found
            if ($wallet) {
                return $wallet; // Return the wallet data
            } else {
                return false; // Return false if no wallet found
            }
        } catch (PDOException $e) {
            // Handle the exception
            return 'Connection failed: ' . $e->getMessage(); // Return error message
        }
    }
    public function update_wallet_if_outdated($email, $newAddress, $crypto)
    {
        try {
            // Connect to the database
            $pdo = $this->connect();

            // Trim and prepare the email
            $email = trim($email);

            // Retrieve the wallet
            $wallet = $this->get_wallet($email);
            // Check if a wallet exists
            if ($wallet) {
                // Get the timechanged from the wallet

                // Check if the difference is greater than or equal to 1 day
                // Prepare the SQL statement to update the address
                $stmt = $pdo->prepare("
                    UPDATE withdrawwallet
                    SET address = :newAddress, timechanged = NOW(),crypto= :crypto
                    WHERE LOWER(email) = LOWER(:email)
                ");

                // Bind parameters
                $stmt->bindParam(':newAddress', $newAddress, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':crypto', $crypto, PDO::PARAM_STR);

                // Execute the query
                $stmt->execute();

                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle any errors
            return "Error: " . $e->getMessage();
        }
    }
    public function get_all_withdrawal_noneconfirmed()
    {
        // Step 1: Connect to the database
        $pdo = $this->connect();

        // Step 2: Prepare and execute the SQL statement to get all unconfirmed withdrawals
        $stmt = $pdo->prepare("
            SELECT * 
            FROM transaction 
            WHERE type = ? 
            AND id NOT IN (SELECT transactionid FROM withdrawalconfirmed)
        ");
        $stmt->execute(["withdraw"]);

        // Step 3: Fetch all rows from the result set
        $withdrawals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Step 4: Return the fetched data (or handle it as needed)
        return $withdrawals;
    }
function insertWithdrawalConfirmation($id, $amount, $email, $confirmed, $transactionId)
{
    try {
        // Connect to the database
        $pdo = $this->connect();

        // Start a transaction

        // Insert into the withdrawalconfirmed table
        $sqlInsert = "INSERT INTO withdrawalconfirmed (amount, email, confirmed, transactionid) VALUES (?, ?, ?, ?)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([$amount, $email, $confirmed, $transactionId]);

        // Check if the insert was successful
        if ($stmtInsert->rowCount() > 0) {
            // Update the withdrawal table status to "confirmed"
            $sqlUpdate = "UPDATE transaction SET success = 'confirmed' WHERE id = ?";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([$id]);

            // Check if the update was successful
            if ($stmtUpdate->rowCount() > 0) {
                // Commit the transaction
                $pdo->commit();
                echo "Record inserted and status updated successfully.";
            } else {
                // Rollback the transaction if update fails
                $pdo->rollBack();
                echo "Failed to update status in the withdrawal table.";
            }
        } else {
            // Rollback the transaction if insert fails
            $pdo->rollBack();
            echo "Failed to insert record into withdrawalconfirmed.";
        }
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


}
