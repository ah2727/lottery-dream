<?php
class withdrawl extends db_connect{
    public function insertwithdrawl($address,$email,$amount,$crypto){
        $currentDateTime = date('Y-m-d H:i:s');

        $pdo = $this->connect();
        $stmt = $pdo->prepare(query: "INSERT INTO withdrawrew (crypto, address, email, timechanged,amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$crypto, $address, $email,$currentDateTime,$amount]);

    }
}