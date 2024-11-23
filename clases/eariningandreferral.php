<?php

class Eariningandreferral extends db_connect{
    public function updatereearningandreferral($referral,$earning){
        try{
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE earningandreferral set earning=?,referral=? WHERE id=?");
        $stmt->execute([$earning, $referral, 1]);
        }catch(Exception $e){
            return "error:" . $e;
        }
    }
    public function getreearningandreferral(){
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM earningandreferral WHERE id=?");
        $stmt->execute([1]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}