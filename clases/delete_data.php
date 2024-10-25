<?php
require_once 'db_connect.php';

class delete_data extends db_connect
{
    public function RemoveToken($tkn,$email){
        $token = $this->connect()->quote($tkn);
        $email1 = $this->connect()->quote($email);
        $this->connect()->query("update register set token=$token where email=$email1");
    }

    function DeleteAdmin($email)
    {
        $pdo = $this->connect()->prepare("delete from administrator where Email = ?");
        $pdo->execute([$email]);

    }
    function DaleteCard($id){
        $pdo = $this->connect()->prepare("delete from cards where id = ?");
        $pdo->execute([$id]);
    }
    function deleteMessage($id)
    {
        $pdo = $this->connect()->prepare("delete from support where id=?");
        $pdo->execute([$id]);
        if ($pdo){
            return true;
        }else{
            return false;
        }
    }
    function DeleteWinners($id){
        $pdo = $this->connect()->prepare("delete from winners where id = ?");
        $pdo->execute([$id]);
    }

    function DeletecardHead($id)
    {
        $pdo = $this->connect()->prepare("delete from cardhead where id = ?");
        $pdo->execute([$id]);
    }
}