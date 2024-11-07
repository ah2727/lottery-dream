<?php
require_once 'db_connect.php';
class gems extends db_connect{
    public function creategems($email){
        try {
            $pdo = $this->connect();

                // Prepare the INSERT statement to insert into gems table
                $sql = "INSERT INTO gems (email, gems) VALUES (:email, :gems)";
                $stmt = $pdo->prepare($sql);
        
                // Bind the email and gems values to the SQL query
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->bindValue(':gems', 0, PDO::PARAM_INT);  // Assuming gems is an integer
        
                // Execute the insert statement
                if ($stmt->execute()) {
                    return "Gems successfully inserted for the user.";
                } else {
                    return "Failed to insert gems.";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
    }
    public function addGems($email, $gemsToAdd) {
        try {
            // Connect to the database
            $pdo = $this->connect();
    
            // Step 1: Retrieve the current number of gems for the given email
            $sql = "SELECT gems FROM gems WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch the current gems value
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $currentGems = $result['gems'];
    
                // Step 2: Calculate the new gems total
                $newGemsTotal = $currentGems + $gemsToAdd;
    
                // Step 3: Update the gems value in the database
                $updateSql = "UPDATE gems SET gems = :newGems WHERE email = :email";
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->bindValue(':newGems', $newGemsTotal, PDO::PARAM_INT);
                $updateStmt->bindValue(':email', $email, PDO::PARAM_STR);
    
                // Execute the update
                if ($updateStmt->execute()) {
                    return "Gems successfully updated for the user.";
                } else {
                    return "Failed to update gems.";
                }
            } else {
                // If no record is found for the given email
                return "No record found for this email.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function addGemsRefrral($invitedemail) {
        try {
            // Connect to the database
            $pdo = $this->connect();
    
            // Step 1: Retrieve the email from userreferral based on referral id
            $sql = "SELECT inviteremail FROM referrallink WHERE invitedemail = :invitedemail";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':invitedemail', $invitedemail, PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch the email
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $transactionCheckSql = "SELECT COUNT(*) as transactionCount FROM transaction WHERE email = :email";
            $transactionCheckStmt = $pdo->prepare($transactionCheckSql);
            $transactionCheckStmt->bindValue(':email', $invitedemail, PDO::PARAM_STR);
            $transactionCheckStmt->execute();

            $transactionCount = $transactionCheckStmt->fetch(PDO::FETCH_ASSOC)['transactionCount'];
            if ($result && $transactionCount == 1) {
                $email = $result['inviteremail'];  // Get the email from the result
    
                // Step 2: Retrieve the current number of gems for the email from the gems table
                $gemsSql = "SELECT gems FROM gems WHERE email = :email";
                $gemsStmt = $pdo->prepare($gemsSql);
                $gemsStmt->bindValue(':email', $email, PDO::PARAM_STR);
                $gemsStmt->execute();
                
                $gemsResult = $gemsStmt->fetch(PDO::FETCH_ASSOC);
    
                if ($gemsResult) {
                    $currentGems = $gemsResult['gems'];
    
                    // Step 3: Calculate the new gems total (add 1 gem)
                    $newGemsTotal = $currentGems + 1;
    
                    // Step 4: Update the gems value in the database
                    $updateSql = "UPDATE gems SET gems = :newGems WHERE email = :email";
                    $updateStmt = $pdo->prepare($updateSql);
                    $updateStmt->bindValue(':newGems', $newGemsTotal, PDO::PARAM_INT);
                    $updateStmt->bindValue(':email', $email, PDO::PARAM_STR);
    
                    // Execute the update
                    if ($updateStmt->execute()) {
                        return "1 gem successfully added for the user.";
                    } else {
                        return "Failed to update gems.";
                    }
                } else {
                    return "No gems record found for this email.";
                }
            } else {
                return "No record found for this referral ID.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function getGems($email){
        try {
            // Connect to the database
            $pdo = $this->connect();
    
            // Prepare the SQL statement to retrieve gems for the given email
            $sql = "SELECT gems FROM gems WHERE email = :email";
            $stmt = $pdo->prepare($sql);
    
            // Bind the email to the query
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the gems value
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return $result['gems'];  // Return the number of gems
            } else {
                return "No gems record found for this email.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

?>