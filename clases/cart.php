<?php
require_once 'db_connect.php';


class Cart extends db_connect
{
    function insertcart($Email, $balls1, $balls2, $balls3, $balls4, $balls5, $balls6, $orderid, $randcode, $CardName, $price, $now, $div, $gems = 0)
    {
        $pdo = $this->connect();
        // Step 4: Insert the order into the order table
        $stmt = $pdo->prepare("INSERT INTO cartitems (Email, balls1, balls2, bals3, balls4, balls5, balls6, orderid, randcode, CardName, price, status, Datet, gems, division) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, ?)");
        $stmt->execute([$Email, $balls1, $balls2, $balls3, $balls4, $balls5, $balls6, $orderid, $randcode, $CardName, $price, $now, $gems, $div]);

        // Step 5: Fetch and return the inserted order record
        $lastInsertId = $pdo->lastInsertId();
        $stmt = $pdo->prepare("SELECT * FROM ordertable WHERE id = ?");
        $stmt->execute([$lastInsertId]);
        $insertedRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        return $insertedRecord;
    }
    function selectCartItemsByEmail($Email, $orderDirection = 'ASC')
    {
        $pdo = $this->connect();

        // Validate the order direction to prevent SQL injection
        $allowedDirections = ['ASC', 'DESC'];
        if (!in_array(strtoupper($orderDirection), $allowedDirections)) {
            $orderDirection = 'ASC'; // Default direction
        }

        // Prepare the query to select all rows with the given email, ordered by orderId
        $sql = "SELECT * FROM cartitems WHERE Email = ? ORDER BY orderId $orderDirection";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$Email]);

        // Fetch all matching records
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $cartItems;
    }
    function deleteCartItemById($id)
    {
        $pdo = $this->connect();

        // Prepare the query to delete the item with the given id
        $stmt = $pdo->prepare("DELETE FROM cartitems WHERE id = ?");
        $result = $stmt->execute([$id]);

        // Return true if the deletion was successful, false otherwise
        return $result;
    }
}
