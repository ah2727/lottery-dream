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
    
            // Step 1: Sum the amount for the specific invited email in the referrallinkamount table
            $referralStmt = $pdo->prepare("SELECT SUM(amount) as totalReferralAmount FROM referrallinkamount WHERE fromemail = ? ORDER BY datetime DESC");
            $referralStmt->execute([$email]);
    
            // Fetch the total referral amount
            $referralResult = $referralStmt->fetch(PDO::FETCH_ASSOC);
            $totalReferralAmount = $referralResult['totalReferralAmount'] ?? 0;
    
            // Step 2: Sum the amount for all users in the user table

    
            // Fetch the total user amount
    
            // Return both sums
            return $totalReferralAmount;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function getTransactionSumsByPeriod($email) {
        try {
            // Get the PDO connection
            $pdo = $this->connect();
    
            // Sum of transactions for today with success = 'bonus'
            $dayQuery = "SELECT DATE(datetime) as date, SUM(amount) as totalAmount 
                         FROM transaction 
                         WHERE email = :email 
                         AND DATE(datetime) = CURDATE() 
                         AND success = 'bonus'
                         GROUP BY DATE(datetime)";
            $dayStmt = $pdo->prepare($dayQuery);
            $dayStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $dayStmt->execute();
            $dayTransaction = $dayStmt->fetch(PDO::FETCH_ASSOC);
    
            // Sum of transactions for the current week with success = 'bonus'
            $weekQuery = "SELECT YEARWEEK(datetime, 1) as week, SUM(amount) as totalAmount 
                          FROM transaction 
                          WHERE email = :email 
                          AND YEARWEEK(datetime, 1) = YEARWEEK(CURDATE(), 1) 
                          AND success = 'bonus'
                          GROUP BY YEARWEEK(datetime, 1)";
            $weekStmt = $pdo->prepare($weekQuery);
            $weekStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $weekStmt->execute();
            $weekTransaction = $weekStmt->fetch(PDO::FETCH_ASSOC);
    
            // Sum of transactions for the current month with success = 'bonus'
            $monthQuery = "SELECT MONTH(datetime) as month, YEAR(datetime) as year, SUM(amount) as totalAmount 
                           FROM transaction 
                           WHERE email = :email 
                           AND MONTH(datetime) = MONTH(CURDATE()) 
                           AND YEAR(datetime) = YEAR(CURDATE()) 
                           AND success = 'bonus'
                           GROUP BY MONTH(datetime), YEAR(datetime)";
            $monthStmt = $pdo->prepare($monthQuery);
            $monthStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $monthStmt->execute();
            $monthTransaction = $monthStmt->fetch(PDO::FETCH_ASSOC);
    
            // Sum of all transactions for the email with success = 'bonus' (no date filter)
            $allQuery = "SELECT SUM(amount) as totalAmount 
                         FROM transaction 
                         WHERE email = :email 
                         AND success = 'bonus'";
            $allStmt = $pdo->prepare($allQuery);
            $allStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $allStmt->execute();
            $allTransaction = $allStmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the summed transactions for day, week, month, and all time
            return [
                'day' => $dayTransaction['totalAmount'] ?? 0,    // Total amount for today
                'week' => $weekTransaction['totalAmount'] ?? 0,  // Total amount for the week
                'month' => $monthTransaction['totalAmount'] ?? 0, // Total amount for the month
                'all' => $allTransaction['totalAmount'] ?? 0     // Total amount for all time
            ];
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
    
    public function getReferralSumsByPeriod($email) {
        try {
            // Get the PDO connection
            $pdo = $this->connect();
    
            // Count of invites for today
            $dayQuery = "SELECT DATE(dateinvite) as date, COUNT(invitedemail) as totalInvites 
                         FROM referrallink 
                         WHERE inviteremail = :email 
                         AND DATE(dateinvite) = CURDATE() 
                         GROUP BY DATE(dateinvite)";
            $dayStmt = $pdo->prepare($dayQuery);
            $dayStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $dayStmt->execute();
            $dayTransaction = $dayStmt->fetch(PDO::FETCH_ASSOC);
    
            // Count of invites for the current week
            $weekQuery = "SELECT YEARWEEK(dateinvite, 1) as week, COUNT(invitedemail) as totalInvites 
                          FROM referrallink 
                          WHERE inviteremail = :email 
                          AND YEARWEEK(dateinvite, 1) = YEARWEEK(CURDATE(), 1) 
                          GROUP BY YEARWEEK(dateinvite, 1)";
            $weekStmt = $pdo->prepare($weekQuery);
            $weekStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $weekStmt->execute();
            $weekTransaction = $weekStmt->fetch(PDO::FETCH_ASSOC);
    
            // Count of invites for the current month
            $monthQuery = "SELECT MONTH(dateinvite) as month, YEAR(dateinvite) as year, COUNT(invitedemail) as totalInvites 
                           FROM referrallink 
                           WHERE inviteremail = :email 
                           AND MONTH(dateinvite) = MONTH(CURDATE()) 
                           AND YEAR(dateinvite) = YEAR(CURDATE()) 
                           GROUP BY MONTH(dateinvite), YEAR(dateinvite)";
            $monthStmt = $pdo->prepare($monthQuery);
            $monthStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $monthStmt->execute();
            $monthTransaction = $monthStmt->fetch(PDO::FETCH_ASSOC);
    
            // Count of all invites for the email (no date filter)
            $allQuery = "SELECT COUNT(invitedemail) as totalInvites 
                         FROM referrallink 
                         WHERE inviteremail = :email";
            $allStmt = $pdo->prepare($allQuery);
            $allStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $allStmt->execute();
            $allTransaction = $allStmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the summed invites for day, week, month, and all time
            return [
                'day' => $dayTransaction['totalInvites'] ?? 0,    // Total invites for today
                'week' => $weekTransaction['totalInvites'] ?? 0,  // Total invites for the week
                'month' => $monthTransaction['totalInvites'] ?? 0, // Total invites for the month
                'all' => $allTransaction['totalInvites'] ?? 0     // Total invites for all time
            ];
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
}