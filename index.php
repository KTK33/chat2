<!DOCTYPE html>
<html>
<head>	
	<title>Login</title>
	<style>
	h1{
			position:relative;
			border-top: 5px outset blue;
			border-bottom: 5px outset blue;
			border-left: 5px outset blue;
			border-right: 5px outset blue;

			margin :  10px auto;
			width : 300px;
		
			background : blue;
			
			color: aqua;
	}
	
	form{
		position:relative;
			border-top: 5px outset red;
			border-bottom: 5px outset red;
			border-left: 5px outset red;
			border-right: 5px outset red;

			margin :  30px auto;
			width : 200px;
		
			background : orange;
			color: blue;
	}
	
	button{
	
		border-top: 1px outset red;
		border-bottom: 1px outset red;
		border-left: 1px outset red;
		border-right: 1px outset red;
			
		margin :  15px 25px;
		width : 150px;
		background : red;
		
		color : white;
	}
	
	</style>
	
</head>

<body>

<h1 style="text-align:center">ログイン画面</h1>
<form action="chat.php" method="POST">
	ID:<input type="text"     name="id" value="<?= $_COOKIE['id'] ?>"><br>
	<br>
	PW:<input type="password" name="pw"><br>
	<button>ログイン</button>
</form>

</body>
</html>
