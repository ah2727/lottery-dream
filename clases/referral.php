<?php

class referral extends db_connect{
    protected function generateRandomString($length = 32) {
        return bin2hex(random_bytes($length / 2)); // Generates a random string of the desired length
    }
    
    public function createreferral($email){
        $pdo = $this->connect();
        $refral = $this->generateRandomString();
        $stmt = $pdo->prepare(query: "INSERT INTO userreferral (email,referal) VALUES (?, ?)");
        $stmt->execute([$email, $refral]);

    }
}