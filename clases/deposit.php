<?php
require_once 'db_connect.php';

class Deposit extends db_connect
{
    public function createOrder($email, $amount)
    {
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');

        // Use the same PDO connection for both the insert and lastInsertId
        $pdo = $this->connect();

        try {
            $earnandshare = $pdo->prepare("SELECT * FROM earningandreferral");
            $earnandshare->execute();
            // Fetch the result
            $earnandshare = $earnandshare->fetch(PDO::FETCH_ASSOC);
            $earn = $earnandshare["earning"] / 100;
            $share = $earnandshare["referral"] / 100;
            $sum = $earn + $share;
            $stmt = $pdo->prepare("INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$amount / (1 + $sum) * $sum, "fee", "loterry@loterry.com", "fee", $currentDateTime]);
            // Prepare and execute the insert query
            $stmt = $pdo->prepare("INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$amount / (1 + $sum), "deposit", $email, "onpay", $currentDateTime]);

            // Return the last inserted ID from the same connection
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return "Order creation failed: " . $e->getMessage();
        }
    }

    public function insertTransaction($email, $traceId, $payId)
    {
        // Get the PDO connection        
        $pdo = $this->connect();

        try {
            // Start a transaction
            $pdo->beginTransaction();

            // Step 1: Retrieve the transaction amount
            $amountStmt = $pdo->prepare("SELECT amount FROM transaction WHERE id = ?");
            $amountStmt->execute([$payId]);
            $transaction = $amountStmt->fetch(PDO::FETCH_ASSOC);

            // Check if transaction exists
            if ($transaction) {
                $transactionAmount = $transaction['amount'];

                // Step 2: Update transaction status to "paid"
                $stmt = $pdo->prepare("UPDATE transaction SET success = ?, oxapaytraceid = ? WHERE id = ?");
                $stmt->execute(['paid', $traceId, $payId]);

                if ($stmt->rowCount() > 0) {
                    // Step 3: Update the user's wallet
                    $walletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                    $walletStmt->execute([$email]);
                    $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);

                    if ($wallet) {
                        $newAmount = $wallet['amount'] + $transactionAmount;

                        // Update the main wallet
                        $updateWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                        $updateWalletStmt->execute([$newAmount, $email]);

                        // Step 4: Check for referral bonus
                        $referralStmt = $pdo->prepare("SELECT inviteremail FROM referrallink WHERE invitedemail = ?");
                        $referralStmt->execute([$email]);
                        $referral = $referralStmt->fetch(PDO::FETCH_ASSOC);

                        if ($referral) {
                            $earnandshare = $pdo->prepare("SELECT * FROM earningandreferral");
                            $earnandshare->execute();
                            $earnandshare = $earnandshare->fetch(PDO::FETCH_ASSOC);

                            $share = $earnandshare['referral'] / 100;
                            $inviterEmail = $referral['inviteremail'];
                            $referralBonus = $transactionAmount * $share;

                            // Step 5: Update inviter's wallet
                            $inviterWalletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                            $inviterWalletStmt->execute([$inviterEmail]);
                            $inviterWallet = $inviterWalletStmt->fetch(PDO::FETCH_ASSOC);

                            if ($inviterWallet) {
                                $newInviterAmount = $inviterWallet['amount'] + $referralBonus;
                                $updateInviterWalletStmt = $pdo->prepare("UPDATE wallet SET amount = ? WHERE email = ?");
                                $updateInviterWalletStmt->execute([$newInviterAmount, $inviterEmail]);

                                // Log referral bonus transaction
                                $currentDateTime = date('Y-m-d H:i:s');
                                $insertTransactionStmt = $pdo->prepare("INSERT INTO transaction (email, amount, type, success, oxapaytraceid, datetime) VALUES (?, ?, ?, ?, ?, ?)");
                                $insertTransactionStmt->execute([$inviterEmail, $referralBonus, 'bonus', 'bonus', $traceId, $currentDateTime]);

                                // Log referral link amount
                                $insertReferral = $pdo->prepare("INSERT INTO referrallinkamount (amount, fromemail, foremail, datetime) VALUES (?, ?, ?, ?)");
                                $insertReferral->execute([$referralBonus, $email, $inviterEmail, $currentDateTime]);
                            } else {
                                $pdo->rollBack();
                                throw new Exception("Inviter's wallet not found.");
                            }
                        }

                        // Commit the transaction
                        $pdo->commit();
                        return "Transaction updated to paid, wallet updated, and referral bonus added (if applicable).";
                    } else {
                        $pdo->rollBack();
                        throw new Exception("Wallet not found for the given email.");
                    }
                } else {
                    $pdo->rollBack();
                    throw new Exception("Transaction ID not found or already updated.");
                }
            } else {
                $pdo->rollBack();
                throw new Exception("Transaction not found.");
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            return "Transaction failed: " . $e->getMessage();
        }
    }
}
