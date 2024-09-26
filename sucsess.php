<?php
include_once 'clases/Cheak.php';
$tezst = new Cheak();
$rss =  $tezst->CheakPay('52208613');
if ($rss->status == "Paid" || $rss->status == ""){
}
var_dump($rss);