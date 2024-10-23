<?php
require_once 'db_connect.php';

class deposit extends db_connect {
    public function createorder($email, $amount) {
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');
        
        // Use the same PDO connection for both the insert and lastInsertId
        $pdo = $this->connect();
        
        // Prepare and execute the insert query
        $stmt = $pdo->prepare(query: "INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$amount, "deposit", $email, "onpay", $currentDateTime]);
        
        // Return the last inserted ID from the same connection
        return $pdo->lastInsertId();
    }
    public function inserttransaction($email, $traceid, $payid) {
        // Get the PDO connection        
        $pdo = $this->connect();
    
        try {
            // Start a transaction
            $pdo->beginTransaction();
    
            // Step 1: Retrieve the transaction amount from the transaction table using payid
            $amountStmt = $pdo->prepare("SELECT amount FROM transaction WHERE id = ?");
            $amountStmt->execute([$payid]);
    
            // Fetch the transaction amount
            $transaction = $amountStmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if transaction exists
            if ($transaction) {
                $transactionAmount = $transaction['amount'];
    
                // Step 2: Update the transaction status to "paid"
                $stmt = $pdo->prepare("UPDATE transaction SET success = ?, oxapaytraceid = ? WHERE id = ?");
                $stmt->execute(['paid', $traceid, $payid]);
    
                // Check if the update was successful
                if ($stmt->rowCount() > 0) {
    
                    // Step 3: Update the wallet of the email performing the transaction
                    $walletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                    $walletStmt->execute([$email]);
                    $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($wallet) {
                        // Calculate the new wallet amount for the email
                        $newAmount = $wallet['amount'] + $transactionAmount;
    
                        // Update the wallet with the new amount
                        $updateWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                        $updateWalletStmt->execute([$newAmount, $email]);
    
                        // Step 4: Check if this email exists as `invitedemail` in the referrallink table
                        $referralStmt = $pdo->prepare("SELECT inviteremail FROM referrallink WHERE invitedemail = ?");
                        $referralStmt->execute([$email]); // Using email to find inviteremail
    
                        $referral = $referralStmt->fetch(PDO::FETCH_ASSOC);
    
                        if ($referral) {
                            // If a referral exists, calculate the 10% referral bonus for the inviter
                            $inviterEmail = $referral['inviteremail'];
                            $referralBonus = $transactionAmount * 0.10;
    
                            // Step 5: Update the inviter's wallet with the 10% referral bonus
                            $inviterWalletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                            $inviterWalletStmt->execute([$inviterEmail]);
                            $inviterWallet = $inviterWalletStmt->fetch(PDO::FETCH_ASSOC);
    
                            if ($inviterWallet) {
                                // Calculate the new amount for the inviter's wallet
                                $newInviterAmount = $inviterWallet['amount'] + $referralBonus;
    
                                // Update the inviter's wallet with the referral bonus
                                $updateInviterWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                                $updateInviterWalletStmt->execute([$newInviterAmount, $inviterEmail]);
                                $currentDateTime = date('Y-m-d H:i:s');

                                // Insert a transaction for the inviter to log the referral bonus
                                $insertTransactionStmt = $pdo->prepare("INSERT INTO transaction (email, amount,type, success, oxapaytraceid, datetime) VALUES (?,?, ?, ?, ?, ?)");
                                $insertTransactionStmt->execute([$inviterEmail ,$referralBonus,'bonus','bonus', $traceid, $currentDateTime]);
                            } else {
                                // If inviter's wallet is not found, roll back
                                $pdo->rollBack();
                                return "Inviter's wallet not found.";
                            }
                        }
    
                        // Step 6: Commit the transaction
                        $pdo->commit();
                        return "Transaction status updated to paid, referral bonus added to inviter's wallet (if applicable), and wallet updated.";
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
