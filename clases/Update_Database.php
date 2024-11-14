<?php
require_once 'db_connect.php';

class Update_Database extends db_connect{
    function UpdateAdminSetting($FullName,$Email,$Role,$id){
        $pdo =$this->connect()->prepare("update administrator set FullName = ? ,Email=?, Role=? where id=?");
        $pdo->execute([$FullName,$Email,$Role,$id]);

    }
    function UpdateAdminSettingFull($FullName,$Email,$password,$Role,$id){
        $pdo = $this->connect()->prepare("update administrator set FullName = ? , Email=?,Password = ?,Role=? where id=?");
        $pdo->execute([$FullName,$Email,$password,$Role,$id]);

    }

    function UpdateProfile($FirstName,$LastName,$address,$mother,$place,$birthDay,$email)
    {
        $pdo = $this->connect()->prepare("update register set fristName = ? ,latName = ? ,Address=? ,mother=?,place=?,birthDay=? where email=?");
        $pdo->execute([$FirstName,$LastName,$address,$mother,$place,$birthDay,$email]);
    }
    function UpdateProfilePassword($email,$FirstName,$LastName,$address,$mother,$place,$birthDay,$password)
    {
        $pdo =  $this->connect()->prepare("update register set fristName = ? ,latName = ? ,Address=? ,mother=?,place=?,birthDay=?,pass=? where email=?");
        $pdo->execute([$FirstName,$LastName,$address,$mother,$place,$birthDay,$password,$email]);

    }

    function UpdateCard($id,$cardHeader,$times,$Money,$winnermoney,$CardName,$color)
    {
            $pdo = $this->connect()->prepare("UPDATE cards set cardHeader=?,times=?,Money=?,winnermoney=?,CardName=?,color=? where id=?");
            $pdo->execute([$cardHeader,$times,$Money,$winnermoney,$CardName,$color,$id]);
    }
    function UpdateCardCount($id,$cardHeader,$countstamp,$Money,$winnermoney,$CardName)
    {
        $pdo = $this->connect()->prepare("UPDATE cards set cardHeader=?,winnermoney=?,countstamp=?,Money=?,CardName=? where id=?");
        $pdo->execute([$cardHeader,$winnermoney,$countstamp,$Money,$CardName,$id]);
    }
    function UpdateCardHead($id,$cardHeader,$times,$Money,$winnermoney,$CardName,$winnermoney_head)
    {
        $pdo = $this->connect()->prepare("UPDATE cardhead set cardHeader=?,times=?,Money=?,winnermoney=?,CardName=?,winnermoney_head=? where id=?");
        $pdo->execute([$cardHeader,$times,$Money,$winnermoney,$CardName,$winnermoney_head,$id]);
    }
    function UpdateCardCountHead($id,$cardHeader,$countstamp,$Money,$winnermoney,$CardName,$winnermoney_head)
    {
        $pdo = $this->connect()->prepare("UPDATE cardhead set cardHeader=?,winnermoney=?,countstamp=?,Money=?,CardName=?,winnermoney_head=? where id=?");
        $pdo->execute([$cardHeader,$winnermoney,$countstamp,$Money,$CardName,$winnermoney_head,$id]);
    }
    function TwoSteps($Email)
    {
        $pdo = $this->connect()->prepare("UPDATE administrator SET TwoSteps=abs(TwoSteps-1) where Email=?");
        $pdo->execute([$Email]);
    }
    function DeleteTrack($trackID)
    {
        $pdo = $this->connect()->prepare("DELETE FROM trackid WHERE trackID=?");
        $pdo->execute([$trackID]);
    }
    function UpdateTrack($trackID)
    {
        $pdo = $this->connect()->prepare("UPDATE trackid SET Status =? where trackID =?");
        $pdo->execute([1,$trackID]);
    }
    function UpdateOrder($order)
    {
        $pdo = $this->connect()->prepare("UPDATE ordertable SET Status =? where orderId =?");
        $pdo->execute([1,$order]);
    }
}