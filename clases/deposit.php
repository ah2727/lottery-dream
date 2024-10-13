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
    
            // Retrieve the transaction amount from the transaction table using payid
            $amountStmt = $pdo->prepare("SELECT amount FROM transaction WHERE id = ?");
            $amountStmt->execute([$payid]);
    
            // Fetch the transaction amount
            $transaction = $amountStmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if transaction exists
            if ($transaction) {
                $transactionAmount = $transaction['amount'];
    
                // Prepare the UPDATE query to change the status to "paid"
                $stmt = $pdo->prepare("UPDATE transaction SET success = ? WHERE id = ?");
                $stmt->execute(['paid', $payid]);
    
                // Check if the update was successful
                if ($stmt->rowCount() > 0) {
                    
                    // Insert into the oxapaytransactionid table if the update was successful
                    $insertStmt = $pdo->prepare("INSERT INTO oxapaytransactionid (traceid, email) VALUES (?, ?)");
                    $insertStmt->execute([$traceid, $email]);
    
                    // Fetch the current wallet amount for the given email
                    $walletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                    $walletStmt->execute([$email]);
                    $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($wallet) {
                        // Calculate the new wallet amount
                        $newAmount = $wallet['amount'] + $transactionAmount;
    
                        // Update the wallet with the new amount
                        $updateWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                        $updateWalletStmt->execute([$newAmount, $email]);
                        
                        // Commit the transaction if everything succeeds
                        $pdo->commit();
                        return "Transaction status updated to paid, oxapay transaction inserted, and wallet updated.";
                    } else {
                        // Roll back if the wallet is not found
                        $pdo->rollBack();
                        return "Wallet not found for the given email.";
                    }
                } else {
                    // Roll back if the update query fails
                    $pdo->rollBack();
                    return "Transaction ID not found or already updated.";
                }
            } else {
                // Roll back if the transaction is not found
                $pdo->rollBack();
                return "Transaction not found.";
            }
    
        } catch (Exception $e) {
            // Roll back the transaction in case of an error
            $pdo->rollBack();
            return "Transaction failed: " . $e->getMessage();
        }
    }
}
?>
