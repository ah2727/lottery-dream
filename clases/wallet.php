<?php
require_once 'db_connect.php';

class wallet extends db_connect{
    public function get_amount($email){
        try {
            // Establish the PDO connection
            $pdo = $this->connect();

            // Prepare the SQL query to search for the email in the wallet table
            $stmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = :email");
            
            // Bind the email parameter to prevent SQL injection
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            // Fetch the result as an associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if an amount was found for the given email
            if ($result && isset($result['amount'])) {
                return $result['amount']; // Return the amount if found
            } else {
                return "No record found for the provided email.";
            }

        } catch (PDOException $e) {
            // Handle any errors that occur during the process
            return "Error: " . $e->getMessage();
        }
    }
    public function get_transactions_by_email($email) {
        try {
            // Establish the PDO connection
            $pdo = $this->connect();
    
            // Prepare the SQL query to fetch all transactions for the given email
            $stmt = $pdo->prepare("
                SELECT * 
                FROM transaction 
                WHERE email = :email
                ORDER BY id DESC
            ");
    
            // Bind the email parameter to prevent SQL injection
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch all results as an associative array
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Check if any transactions were found
            if ($transactions) {
                return $transactions; // Return the array of transactions
            } else {
                return "No transactions found for the provided email.";
            }
    
        } catch (PDOException $e) {
            // Handle any errors that occur during the process
            return "Error: " . $e->getMessage();
        }
    }
    public function buy($email,$amount){
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');
    
        // Use the PDO connection
        $pdo = $this->connect();
    
        // Step 1: Check wallet balance
        $stmt = $pdo->prepare("SELECT amount FROM wallet WHERE email = ?");
        $stmt->execute([$email]);
        $wallet = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if wallet exists and if the balance is sufficient
        if ($wallet && $wallet['amount'] >= $amount) {
            
            // Step 2: Execute the withdrawal if balance is sufficient
            $stmt = $pdo->prepare("INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$amount, "buy", $email, "lottery", $currentDateTime]);
    
            // Get the last inserted ID for the transaction
            $transactionId = $pdo->lastInsertId();
    
            // Step 3: Deduct the amount from the wallet
            $stmt = $pdo->prepare("UPDATE wallet SET amount = amount - ? WHERE email = ?");
            $stmt->execute([$amount, $email]);
            $_SESSION["success"]="success";
            return $transactionId; // Return the transaction ID for reference    }
        }
}
}