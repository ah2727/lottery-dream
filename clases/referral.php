<?php
require_once 'db_connect.php';

class referral extends db_connect{
    protected function generateRandomString($length = 32) {
        return bin2hex(random_bytes($length / 2)); // Generates a random string of the desired length
    }
    public function createreferral($email) {
        // Connect to the database
        $pdo = $this->connect();
        
        // Check if the email already exists in the userreferral table
        $checkSql = "SELECT COUNT(*) FROM userreferral WHERE email = :email";
        $checkStmt = $pdo->prepare($checkSql); // No need to call connect() again
        $checkStmt->bindValue(':email', $email, PDO::PARAM_STR); // Ensure email is bound as a string
        $checkStmt->execute();
        
        // Fetch the result (returns 1 if the email exists, 0 if it does not)
        $referralExist = $checkStmt->fetchColumn();
        
        if ($referralExist == 0) {
            // Email doesn't exist, create a new referral code
            $referral = $this->generateRandomString(32); // Generate a 32-character random string
            $stmt = $pdo->prepare("INSERT INTO userreferral (email, referral) VALUES (?, ?)");
            $stmt->execute([$email, $referral]);
            echo "Referral created successfully.\n";
        } else {
            echo "Referral already exists, skipping...\n";
        }
    }
    public function getReferralByEmail($email) {
        try {
            // Connect to the database
            $pdo = $this->connect();
            
            // Prepare the SQL query to search for the referral by email
            $sql = "SELECT * FROM userreferral WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            
            // Bind the email parameter to the query
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            
            // Execute the query
            $stmt->execute();
            
            // Fetch the result (returns false if no record is found)
            $referral = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($referral) {
                return $referral; // Return the referral record if found
            } else {
                return "No referral found for the provided email.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function insertReferral($referral_id, $invited_email){
        try {
            $pdo = $this->connect();
            
            // Check if the referral exists
            $sql = "SELECT * FROM userreferral WHERE referral = :referral";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':referral', $referral_id, PDO::PARAM_STR);
            $stmt->execute();
            
            // Fetch the result (returns false if no record is found)
            $referral = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($referral) {
                
                // Check if the invited email already exists in referrallink
                $check_sql = "SELECT * FROM referrallink WHERE invitedemail = :invitedemail";
                $check_stmt = $pdo->prepare($check_sql);
                $check_stmt->bindValue(':invitedemail', $invited_email, PDO::PARAM_STR);
                $check_stmt->execute();
    
                // If the invited email is not found, proceed to insert
                if (!$check_stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Get the current date
                    $currentDate = date('Y-m-d H:i:s'); // For DATETIME format
    
                    // Prepare insert statement with a date field
                    $insert_sql = "INSERT INTO referrallink (inviteremail, invitedemail, inviterreferral, dateinvite) 
                                   VALUES (:inviteremail, :invitedemail, :inviterreferral, :dateinvite)";
                    $insert_stmt = $pdo->prepare($insert_sql);
    
                    // Bind values for the insert statement
                    $insert_stmt->bindValue(':inviteremail', $referral['email'], PDO::PARAM_STR);  // Assuming 'email' is the inviter's email in userreferral table
                    $insert_stmt->bindValue(':invitedemail', $invited_email, PDO::PARAM_STR);
                    $insert_stmt->bindValue(':inviterreferral', $referral_id, PDO::PARAM_STR);
                    $insert_stmt->bindValue(':dateinvite', $currentDate, PDO::PARAM_STR);  // Bind current date
    
                    // Execute the insert
                    if ($insert_stmt->execute()) {
                        return "Referral successfully inserted into referrallink table.";
                    } else {
                        return "Failed to insert referral into referrallink table.";
                    }
                } else {
                    return "Invited email already exists in referrallink table.";
                }
            } else {
                return "No referral found for the provided referral ID.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function get_friends($email) {
        try {
            // Connect to the database
            $pdo = $this->connect();
    
            // Prepare the SQL statement to fetch all records where the email is the inviter
            $sql = "SELECT *
                    FROM referrallink 
                    WHERE inviteremail = :inviteremail";
            $stmt = $pdo->prepare($sql);
    
            // Bind the inviter's email to the SQL query
            $stmt->bindValue(':inviteremail', $email, PDO::PARAM_STR);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch all results
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Check if any results were found
            if ($result) {
                return $result;  // Return all the referral data
            } else {
                return "No referrals found for this email.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }  
    public function getInvitedWalletBonus($email) {
        try {
            // Get the PDO connection
            $pdo = $this->connect();
    
            // Step 1: Find the invited email using the inviter email
            $referralStmt = $pdo->prepare("SELECT invitedemail FROM referrallink WHERE inviteremail = ?");
            $referralStmt->execute([$email]);
    
            // Fetch the invited user's email
            $referral = $referralStmt->fetch(PDO::FETCH_ASSOC);
    
            if ($referral) {
                $invitedEmail = $referral['invitedemail'];
    
                // Step 2: Retrieve the wallet balance for the invited user
                $walletStmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
                $walletStmt->execute([$invitedEmail]);
    
                // Fetch the invited user's wallet balance
                $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);
    
                if ($wallet) {
                    // Calculate 10% of the invited user's wallet balance
                    $invitedWalletAmount = $wallet['amount'];
                    $bonusAmount = $invitedWalletAmount * 0.10;
    
                    // Return the 10% bonus
                    return $bonusAmount;
                } else {
                    return "Invited user's wallet not found.";
                }
            } else {
                return "No invited user found for this inviter email.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
}