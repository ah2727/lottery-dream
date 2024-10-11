<?php
class deposit extends db_connect {
    public function createorder($email, $amount) {
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');
        
        // Use the same PDO connection for both the insert and lastInsertId
        $pdo = $this->connect();
        
        // Prepare and execute the insert query
        $stmt = $pdo->prepare("INSERT INTO transaction (amount, type, email, success, datetime) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$amount, "deposit", $email, "onpay", $currentDateTime]);
        
        // Return the last inserted ID from the same connection
        return $pdo->lastInsertId();
    }
}
?>
