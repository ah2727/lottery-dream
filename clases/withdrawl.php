<?php
class withdrawl extends db_connect{
    public function insertwithdrawwallet($address,$email,$crypto){
        $currentDateTime = date('Y-m-d H:i:s');

        $pdo = $this->connect();
        $stmt = $pdo->prepare(query: "INSERT INTO withdrawwallet (crypto, address, email, timechanged) VALUES (?, ?, ?, ?)");
        $stmt->execute([$crypto, $address, $email,$currentDateTime]);

    }
}