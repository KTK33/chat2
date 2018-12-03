
<?php
function connectDB(){
	$dsn  = 'mysql:dbname=chat;host=127.0.0.1';   //接続先
	$user = 'root';         //MySQLのユーザーID
	$pw   = 'H@chiouji1';   //MySQLのパスワード
	return(
		new PDO($dsn, $user, $pw)
	);
}

class APIBase
{
	protected function sendjson($flag,$body=null){
		echo json_encode([
			"head"=> [
				"status"=> $flag
			]
			,"body" => $body;
		]);
	}
}

	class ChatAPI extends APIBase{
	function get($name=null){		
		$result = [];
		$value = [];
		try
		{
			$buff = $sth->fetch(PDO::FETCH_ASSOC);
			if( $name === null )
			{
				$sql = 'SELECT * FROM log';
			}
		
			$result[] = [
				  "name"    => $buff["name"]
				, "message" => $buff["message"]
				, "time"    => $buff["time"]
				];
				
			$flag = true;
		}
		catch(PDOException &e){
		$flag = false;	
		}
	
		$this->sendjson($flag,$result);
	}
	function set($name,$message)
	{
		$sql = 'INSERT INTO log(name,message,time) VALUES(?,?,?)';
		try{
			$dbh = connectDB();                 //接続
			$dbh->beginTransaction();
			$sth = $dbh->prepare($sql);         //SQL準備
			$sth->execute([
							$name,	
							$message,
							date("Y-m-d H:i:s",time())]
						);  //実行
			$dbh->commit();
			$flag = true;
			}
		catch(PDOException $e){
			$dbh->rollback();
			$flag = false;
		}
		
		$this->sendjson($flag);
	}
}
