<?php

class wallet extends db_connect{
    public function createwallet($email) {
        try {
            // List of wallets to create
            $wallets = [
                'BNB',
                'Tether',
                'TON',
                'Doge',
                'Bitcoin'
            ];
    
            // Prepare the SQL statement to check if the wallet already exists
            $checkSql = "SELECT COUNT(*) FROM wallet WHERE crypto = :crypto AND email = :email";
            $checkStmt = $this->connect()->prepare($checkSql);
    
            // Prepare the SQL statement to insert the new wallet
            $insertSql = "INSERT INTO wallet (crypto, amount, email) VALUES (:crypto, :amount, :email)";
            $insertStmt = $this->connect()->prepare($insertSql);
    
            // Loop through each wallet and insert it into the wallets table if it doesn't exist
            foreach ($wallets as $crypto) {
                // Bind the parameters for the check query
                $checkStmt->bindValue(':crypto', $crypto);
                $checkStmt->bindValue(':email', $email);
                $checkStmt->execute();
                
                // Fetch the result (returns 1 if exists, 0 if not)
                $walletExists = $checkStmt->fetchColumn();
    
                if ($walletExists == 0) {
                    // Wallet doesn't exist, insert a new one
                    $amount = 0.00;  // Default amount
                    $insertStmt->bindValue(':crypto', $crypto);
                    $insertStmt->bindValue(':amount', $amount); // Treat amount as a numeric value
                    $insertStmt->bindValue(':email', $email);
                    $insertStmt->execute();
                    
                    echo "Created wallet for $crypto\n";
                } else {
                    echo "Wallet for $crypto already exists, skipping...\n";
                }
            }
    
            echo "Wallet creation process completed for user: $email\n";
        } catch (PDOException $e) {
            echo "Error creating wallets: " . $e->getMessage();
        }
    }
    
}