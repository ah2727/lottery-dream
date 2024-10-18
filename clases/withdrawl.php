<?php
require_once 'db_connect.php';

class withdrawl extends db_connect{
    public function createwithdraw($email, $amount) {
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');
        
        // Use the same PDO connection for both the insert and lastInsertId
        $pdo = $this->connect();
        
        // Prepare and execute the insert query
        $stmt = $pdo->prepare(query: "INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$amount, "withdraw", $email, "lottery", $currentDateTime]);
        
        // Return the last inserted ID from the same connection
        return $pdo->lastInsertId();
    }
    public function insertwithdrawwallet($address,$email,$crypto){
        $currentDateTime = date(format: 'Y-m-d H:i:s');

        $pdo = $this->connect();
        $stmt = $pdo->prepare(query: "INSERT INTO withdrawwallet (crypto, address, email, timechanged) VALUES (?, ?, ?, ?)");
        $stmt->execute([$crypto, $address, $email,$currentDateTime]);

    }
    public function get_wallet($email){
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
    public function update_wallet_if_outdated($email, $newAddress) {
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
                $lastChanged = new DateTime($wallet['timechanged']);
                $now = new DateTime();
    
                // Calculate the difference in days
                $interval = $lastChanged->diff($now);
    
                // Check if the difference is greater than or equal to 1 day
                if ($interval->days >= 1) {
                    // Prepare the SQL statement to update the address
                    $stmt = $pdo->prepare("
                        UPDATE withdrawwallet
                        SET address = :newAddress, timechanged = NOW()
                        WHERE LOWER(email) = LOWER(:email)
                    ");
    
                    // Bind parameters
                    $stmt->bindParam(':newAddress', $newAddress, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
                    // Execute the query
                    $stmt->execute();
    
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle any errors
            return "Error: " . $e->getMessage();
        }
    }
}