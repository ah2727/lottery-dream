<?php

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
    public function insertReferral($referral_id,$invited_email){
        try{
        $pdo = $this->connect();
        $sql = "SELECT * FROM userreferral WHERE referral = :referral";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':referral', $referral_id, PDO::PARAM_STR);
        $stmt->execute();
        // Fetch the result (returns false if no record is found)
        $referral = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($referral) {
            
            // Prepare insert statement
            $insert_sql = "INSERT INTO referrallink (inviteremail, invitedemail, inviterreferral) 
                           VALUES (:inviteremail, :invitedemail, :inviterreferral)";
            $insert_stmt = $pdo->prepare($insert_sql);

            // Bind values for the insert statement
            $insert_stmt->bindValue(':inviteremail', $referral['email'], PDO::PARAM_STR);  // Assuming 'email' is the inviter's email in userreferral table
            $insert_stmt->bindValue(':invitedemail', $invited_email, PDO::PARAM_STR);
            $insert_stmt->bindValue(':inviterreferral', $referral_id, PDO::PARAM_STR);

            // Execute the insert
            if ($insert_stmt->execute()) {
                return "Referral successfully inserted into referrallink table.";
            } else {
                return "Failed to insert referral into referrallink table.";
            }
        } else {
            return "No referral found for the provided email.";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }

    }
}