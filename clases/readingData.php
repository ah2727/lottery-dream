<?php
require_once 'db_connect.php';

class readingData extends db_connect
{
    function readbyemail($email)
    {
        $pdo = $this->connect();
        $Emailq = $pdo->quote($email);
    $res = $pdo->query("select * from register where email = $Emailq")->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    function readAllAdmin()
    {
        return $this->connect()->query("select * from administrator")->fetchAll(PDO::FETCH_ASSOC);
    }

    function LoginAdministrator($email)
    {
        $pdo = $this->connect()->prepare("select * from administrator where email = ?");
        $pdo->execute([$email]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function selectbyId($id)
    {
        $pdo = $this->connect()->prepare("select * from administrator where id = ?");
        $pdo->execute([$id]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function counuserName(){
        return $this->connect()->query("select count(id) from register")->fetch(PDO::FETCH_ASSOC);
    }
    function counCards(){
        return $this->connect()->query("select count(id) from cards")->fetch(PDO::FETCH_ASSOC);
    }
    function countBuy(){
        return $this->connect()->query("select count(id) from ordertable")->fetch(PDO::FETCH_ASSOC);
    }
    function councardhead(){
        return $this->connect()->query("select count(id) from cardhead")->fetch(PDO::FETCH_ASSOC);
    }
    function readCards(){
        return $this->connect()->query("select * from cards limit 10")->fetchAll(PDO::FETCH_ASSOC);
    }
    function readCardsAll(){
        return $this->connect()->query("select * from cards")->fetchAll(PDO::FETCH_ASSOC);
    }
    function redCardById($id){
         $pdo = $this->connect()->prepare("select * from cards where id = ?");
          $pdo->execute([$id]);
         $res = $pdo->fetch(PDO::FETCH_ASSOC);
         return $res;
    }
    function redCardHeadById($id){
        $pdo = $this->connect()->prepare("select * from cardhead where id = ?");
        $pdo->execute([$id]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function ReadToken($CardName){
        $pdo = $this->connect()->prepare('SELECT * FROM ordertable where CardName = ? AND status=? order BY RAND() LIMIT 1');
        $pdo->execute([$CardName,1]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function selProfile($email){
        $pdo = $this->connect()->prepare("select * from register where email = ?");
        $pdo->execute([$email]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    function selCard()
    {
        return $this->connect()->query("SELECT * FROM cardhead order by id desc LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
    }
    function selCardById($id)
    {
     $pdo = $this->connect()->prepare("select * from cards where id = ?");
     $pdo->execute([$id]);
     $res = $pdo->fetch(PDO::FETCH_ASSOC);
     return $res;
    }
    function ReadMessage()
    {
        return $this->connect()->query("select * from support")->fetchAll(PDO::FETCH_ASSOC);

    }

    function ReadMessageByid($id)
    {

        $pdo = $this->connect()->prepare("select * from support where id=?");
        $pdo->execute([$id]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function selCarsWithName($name){
        $pdo = $this->connect()->prepare("select * from cards where CardName=?");
        $pdo->execute([$name]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function selCarsWithName1($name){
        $pdo = $this->connect()->prepare("select * from cardhead where CardName=?");
        $pdo->execute([$name]);
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    function selWinner()
    {
        $pdo = $this->connect()->query("select * from winners")->fetchAll(PDO::FETCH_ASSOC);
        return $pdo;
    }
    function selWinnerCardName($CardName)
    {
        $pdo = $this->connect()->prepare("select * from winners where CardName = ? order by Date DESC ");
        $pdo->execute([$CardName]);
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function ReadShop($email)
    {
        $pdo = $this->connect()->prepare("select * from ordertable where Email = ? order by id desc ");
        $pdo->execute([$email]);
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function selWinnerEmail($email)
    {
        $pdo = $this->connect()->prepare("select * from winners where Email = ? ");
        $pdo->execute([$email]);
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function selAllby()
    {
        $pdo = $this->connect()->query("select * from ordertable where status = 1");
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function  SelTrack($email)
    {
        $pdo = $this->connect()->prepare("select * from trackid where Email=? and Status !=?");
        $pdo->execute([$email,1]);
        $res =$pdo->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function  selectTrackk($email)
    {
        $pdo = $this->connect()->prepare("select * from trackid where Email=? and Status =?");
        $pdo->execute([$email,1]);
        $res =$pdo->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}