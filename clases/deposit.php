<?php
require_once 'db_connect.php';

class deposit extends db_connect {
    public function createorder($email, $amount,$crypto) {
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');
        
        // Use the same PDO connection for both the insert and lastInsertId
        $pdo = $this->connect();
        
        // Prepare and execute the insert query
        $stmt = $pdo->prepare(query: "INSERT INTO transaction (amount, type, email, success, datetime,crypto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$amount, "deposit", $email, "onpay", $currentDateTime,$crypto]);
        
        // Return the last inserted ID from the same connection
        return $pdo->lastInsertId();
    }
    public function inserttransaction($email, $traceid, $payid) {
        // Get the PDO connection
        $pdo = $this->connect();
        
        try {
            // Start a transaction
            $pdo->beginTransaction();

            // Prepare the UPDATE query to change the status to "paid"
            $stmt = $pdo->prepare("UPDATE transaction SET success = ? WHERE id = ?");
            
            // Execute the UPDATE query
            $stmt->execute(['paid', $payid]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                // Insert into the oxapaytransactionid table if the update was successful
                $insertStmt = $pdo->prepare("INSERT INTO oxapaytransactionid (traceid, email) VALUES (?, ?)");
                $insertStmt->execute([$traceid, $email]);

                // Commit the transaction if both queries succeed
                $pdo->commit();
                return "Transaction status updated to paid and oxapay transaction inserted.";
            } else {
                // Roll back if the update query fails
                $pdo->rollBack();
                return "Transaction ID not found or already updated.";
            }

        } catch (Exception $e) {
            // Roll back the transaction in case of an error
            $pdo->rollBack();
            return "Transaction failed: " . $e->getMessage();
        }
    }
}
?>
