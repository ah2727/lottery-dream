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
                        // Step 4: Check if this email exists as `invitedemail` in the referrallink table
                        $referralStmt = $pdo->prepare("SELECT inviteremail FROM referrallink WHERE invitedemail = ?");
                        $referralStmt->execute([$email]);
    
                        $referral = $referralStmt->fetch(PDO::FETCH_ASSOC);
    
                        // Determine the new wallet amount based on referral existence
                        $newAmount = $wallet['amount'] + $transactionAmount * ($referral ? 0.9 : 1);
                        $stmt = $pdo->prepare("UPDATE transaction SET success = ?, oxapaytraceid = ?, amount = ? WHERE id = ?");
                        $stmt->execute(params: ['paid', $traceid, $newAmount, $payid]);
                        // Update the main wallet with the calculated amount
                        $updateWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                        $updateWalletStmt->execute([$newAmount, $email]);
    
                        // If a referral exists, proceed to update the inviter's wallet
                        if ($referral) {
                            $inviterEmail = $referral['inviteremail'];
                            $referralBonus = $transactionAmount * 0.10;
    
                            // Add bonus to inviter's wallet
                            $inviterWalletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                            $inviterWalletStmt->execute([$inviterEmail]);
                            $inviterWallet = $inviterWalletStmt->fetch(PDO::FETCH_ASSOC);
    
                            if ($inviterWallet) {
                                // Update inviter's wallet with referral bonus
                                $newInviterAmount = $inviterWallet['amount'] + $referralBonus;
                                $updateInviterWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                                $updateInviterWalletStmt->execute([$newInviterAmount, $inviterEmail]);
    
                                // Log referral bonus transaction
                                $currentDateTime = date('Y-m-d H:i:s');
                                $insertTransactionStmt = $pdo->prepare("INSERT INTO transaction (email, amount, type, success, oxapaytraceid, datetime) VALUES (?, ?, ?, ?, ?, ?)");
                                $insertTransactionStmt->execute([$inviterEmail, $referralBonus, 'bonus', 'bonus', $traceid, $currentDateTime]);
                            } else {
                                $pdo->rollBack();
                                return "Inviter's wallet not found.";
                            }
                        }
    
                        // Step 6: Commit the transaction
                        $pdo->commit();
                        return "Transaction status updated to paid, referral bonus added to inviter's wallet (if applicable), and wallet updated.";
                    } else {
                        $pdo->rollBack();
                        return "Wallet not found for the given email.";
                    }
                } else {
                    $pdo->rollBack();
                    return "Transaction ID not found or already updated.";
                }
            } else {
                $pdo->rollBack();
                return "Transaction not found.";
            }
    
        } catch (Exception $e) {
            $pdo->rollBack();
            return "Transaction failed: " . $e->getMessage();
        }
    }
    
    
}
?>
