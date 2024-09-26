<?php
class onlineUsers extends db_connect
{
    function getOnlineUsers()
    {
        $sessionId = session_id();
        $time = time();
        $pdo =$this->connect()->prepare("select * from onlineusers where session = ?");
        $pdo->execute([$sessionId]);
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($res)){
            $this->connect()->query("update onlineusers set time = '$time' where session='$sessionId'");
        }else{
            $pdo1 = $this->connect()->prepare("insert into onlineusers(session,TIME) values (?,?)");
            $pdo1->execute([$sessionId,$time]);
        }
        $timeoffset=60;
        $offlineTime = $time-$timeoffset;
        return $this->connect()->query("select count(id) from onlineusers where TIME > $offlineTime")->fetch(PDO::FETCH_ASSOC);
    }
}