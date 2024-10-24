<?php

require_once 'db_connect.php';

class viwe extends db_connect
{
    function DayViwe()
    {
        $sessionId = session_id();
        $time = time();
        $pdo =$this->connect()->prepare("select * from viweinday where keySession  = ?");
        $pdo->execute([$sessionId]);
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($res)){
            $this->connect()->query("update viweinday set Datet = '$time' where keySession ='$sessionId'");
        }else{
            $pdo1 = $this->connect()->prepare("insert into viweinday(keySession ,Datet) values (?,?)");
            $pdo1->execute([$sessionId,$time]);
        }
        $timeoffset=24 * 60 * 60;
        $offlineTime = $time-$timeoffset;
        return $this->connect()->query("select count(id) from viweinday where Datet > $offlineTime")->fetch(PDO::FETCH_ASSOC);
    }
    function MonthViwe()
    {
        $sessionId = session_id();
        $time = time();
        $pdo =$this->connect()->prepare("select * from viweinmonth where session_id  = ?");
        $pdo->execute([$sessionId]);
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($res)){
            $this->connect()->query("update viweinmonth set datet = '$time' where session_id ='$sessionId'");
        }else{
            $pdo1 = $this->connect()->prepare("insert into viweinmonth(session_id ,datet) values (?,?)");
            $pdo1->execute([$sessionId,$time]);
        }
        $timeoffset=30* 24 * 60 * 60;
        $offlineTime = $time-$timeoffset;
        return $this->connect()->query("select count(id) from viweinmonth where datet > $offlineTime")->fetch(PDO::FETCH_ASSOC);
    }
    function selMviwe()
    {
        $time = time();
        $timeoffset=30* 24 * 60 * 60;
        $offlineTime = $time-$timeoffset;
        return $this->connect()->query("select count(id) from viweinmonth where datet > $offlineTime")->fetch(PDO::FETCH_ASSOC);
    }
    function selDay()
    {
        $time = time();
        $timeoffset=30* 24 * 60 * 60;
        $offlineTime = $time-$timeoffset;
        return $this->connect()->query("select count(id) from viweinmonth where datet > $offlineTime")->fetch(PDO::FETCH_ASSOC);
    }
}