<?php
require('lib.php');
$uname = $_POST["uname"];
$msg   = $_POST["msg"];
$time  = time();
//-------------------------------------------------
//準備
//-------------------------------------------------
// 実行したいSQL
$sql = 'INSERT INTO log(name,message,time) VALUES(?,?,?)';
//-------------------------------------------------
//SQLを実行
//-------------------------------------------------
$dbh = connectDB();                 //接続
$sth = $dbh->prepare($sql);         //SQL準備
$sth->execute([$uname,$msg,date("Y-m-d H:i:s",$time)]);  //実行
echo json_encode([
	"status"=>true
]);
