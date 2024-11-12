<?php
require_once 'db_connect.php';

class register extends db_connect
{
    public function Signup($email,$pass,$fristName,$latName,$Address,$mother,$place,$birthDay,$Gender,$phone){
        $pdo = $this->connect()->prepare("insert into register(email,pass,fristName,latName,Address,mother,place,birthDay,Gender,phone) values (?,?,?,?,?,?,?,?,?,?)");
        $pdo->execute([$email,$pass,$fristName,$latName,$Address,$mother,$place,$birthDay,$Gender,$phone]);
        if ($pdo){
            return true;
        }
        else{
            return false;
        }
    }
    public function login($email){
        $pdo = $this->connect()->prepare("select * from register where email = ?");
        $pdo->execute([$email]);
        return $pdo->fetch(PDO::FETCH_ASSOC);
    }
    public function changeprofile($email,$fistName,$lastName,$address,$positalcode){
        $pdo = $this->connect()->query("update register set fristName = '$fistName',latName ='$lastName', Address = '$address' , positalcode='$positalcode' where email='$email'");
    }
    function UpdateAllFeild($email,$password,$fristName,$lastName,$Address,$positalcode){
        $pdo = $this->connect()->query("update register set pass = '$password' ,fristName = '$fristName',latName = '$lastName',Address = '$Address',positalcode = '$positalcode' where email = '$email'");

    }

    function SelectbyEmail($email)
    {
        $pdo =$this->connect()->prepare("select * from register where email = ?");
        $pdo->execute([$email]);
        return $pdo->fetch(PDO::FETCH_ASSOC);
    }
    function insertToken($token,$email)
    {
        $pdo = $this->connect()->query("update register set token='$token' where email='$email'");
    }

    function updatePassword($email,$token,$password)
    {
        $email1 = $this->connect()->quote($email);
        $token1 = $this->connect()->quote($token);
        $password1 = $this->connect()->quote($password);

        $pdo = $this->connect()->query("update register set pass=$password1 where email = $email1 and token = $token1");
    }
    function AddNewAdmin($FullName,$email,$Password,$role)
    {
        $pdo = $this->connect()->prepare("insert into administrator(FullName,Email,Password,TwoSteps,onlineStatus,Role) values (?,?,?,?,?,?)");
        $res = $pdo->execute([$FullName,$email,$Password,0,0,$role]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    function addnewCard($cardImage,$cardHeader,$times,$money,$winnerMoney,$token,$CardName,$bg_Image,$result_Image,$countstamp,$Basket,$winnermoby_head)
    {
        $pdo = $this->connect()->prepare("insert into cards(cardImage,cardHeader,times,Money,winnermoney,CardToken,CardName,bg_Image,result_Image,countstamp,Basket_Image,winnermoney_head) values (?,?,?,?,?,?,?,?,?,?,?,?)");
        $res = $pdo->execute([$cardImage,$cardHeader,$times,$money,$winnerMoney,$token,$CardName,$bg_Image,$result_Image,$countstamp,$Basket,$winnermoby_head]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }
    function addnewCardHeader($cardImage,$cardHeader,$times,$money,$winnerMoney,$token,$CardName,$bg_Image,$bg_HeaderImage,$winnermoney_head,$resultImage,$countstamp,$Basket_Image)
    {
        $pdo = $this->connect()->prepare("insert into cardhead(cardImage,cardHeader,times,Money,winnermoney,CardToken,CardName,bg_Image,cardHeadImage,winnermoney_head,result_Image,countstamp,Basket_Image) values (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $res = $pdo->execute([$cardImage,$cardHeader,$times,$money,$winnerMoney,$token,$CardName,$bg_Image,$bg_HeaderImage,$winnermoney_head,$resultImage,$countstamp,$Basket_Image]);
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    function addnewTcket($email,$subject,$cardToken,$image,$text)
    {
        $pdo = $this->connect()->prepare("insert into support(email,subject,cardToken,file,text) values (?,?,?,?,?)");
        $pdo->execute([$email,$subject,$cardToken,$image,$text]);
    }
    function addnewWinner($email,$CardName,$BALLS1,$BALLS2,$BALLS3,$BALLS4,$BALLS5,$BALLS6,$random,$ORDERID)
    {
        $pdo = $this->connect()->prepare("insert into winners(email,CardName,BALLS1,BALLS2,BALLS3,BALLS4,BALLS5,BALLS6,random,ORDERID,Date) values (?,?,?,?,?,?,?,?,?,?,?)");
        $pdo->execute([$email,$CardName,$BALLS1,$BALLS2,$BALLS3,$BALLS4,$BALLS5,$BALLS6,$random,$ORDERID,date('Y-m-d')]);
    }
    function addnewTcketP($email,$subject,$cardToken,$text)
    {
        $pdo = $this->connect()->prepare("insert into support(email,subject,cardToken,text) values (?,?,?,?)");
        $pdo->execute([$email,$subject,$cardToken,$text]);
    }
    function InsertOrderTabel($Email, $balls1, $balls2, $balls3, $balls4, $balls5, $balls6, $orderid, $randcode, $CardName, $price, $now, $div,$gems=0) {
        $pdo = $this->connect();
    
        // Step 1: Check gem balance for the given email
        $stmt = $pdo->prepare("SELECT gems FROM gems WHERE email = ?");
        $stmt->execute([$Email]);
        $userGemRecord = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$userGemRecord) {
            return "Error: User gem balance not found."; // User has no gem record
        }
    
        $currentGemBalance = $userGemRecord['gems'];
    
        // Step 2: Check if the user has enough gems
        if ($currentGemBalance < $gems) {
            return "Error: Not enough gems to complete this transaction.";
        }
    
        // Step 3: Deduct the gems from the user's balance
        $newGemBalance = $currentGemBalance - $gems;
        $stmt = $pdo->prepare("UPDATE gems SET gems = ? WHERE email = ?");
        $stmt->execute([$newGemBalance, $Email]);
    
        // Step 4: Insert the order into the order table
        $stmt = $pdo->prepare("INSERT INTO ordertable (Email, balls1, balls2, bals3, balls4, balls5, balls6, orderid, randcode, CardName, price, status, Datet, gems, division) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, ?)");
        $stmt->execute([$Email, $balls1, $balls2, $balls3, $balls4, $balls5, $balls6, $orderid, $randcode, $CardName, $price, $now, $gems, $div]);
    
        // Step 5: Fetch and return the inserted order record
        $lastInsertId = $pdo->lastInsertId();
        $stmt = $pdo->prepare("SELECT * FROM ordertable WHERE id = ?");
        $stmt->execute([$lastInsertId]);
        $insertedRecord = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $insertedRecord;
    }
    

    function  insertTrak($email,$track,$orderid)
    {
        $pdo = $this->connect()->prepare("insert into trackid(trackID,Email,orderId,status) values(?,?,?,?)");
        $pdo->execute([$track,$email,$orderid,0]);
    }

}