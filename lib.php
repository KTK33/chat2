
<?php
function connectDB(){
	$dsn  = 'mysql:dbname=chat;host=127.0.0.1';   //接続先
	$user = 'root';         //MySQLのユーザーID
	$pw   = 'H@chiouji1';   //MySQLのパスワード
	return(
		new PDO($dsn, $user, $pw)
	);
}
