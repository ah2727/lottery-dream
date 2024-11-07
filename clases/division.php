<?php
class division extends db_connect
{
    public function inserted_division($orderid,$divide){
        $pdo = $this->connect();

        $stmt = $pdo->prepare("INSERT INTO division (orderid, divide) VALUES (?, ?)");
    
        // Execute the query with the provided parameters
        $stmt->execute([$orderid, $divide]);
        
        // Optionally, return a confirmation or the inserted record
        return $pdo->lastInsertId();
    }
}
?>
