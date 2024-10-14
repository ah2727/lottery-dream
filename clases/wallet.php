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
}