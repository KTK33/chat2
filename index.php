<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

<h1>ログイン</h1>
<form action="chat.php">
	<input type="text" name="uname" value="<?= $_COOKIE['uname'] ?>">
	<button>ログイン</button>
</form>

</body>
</html>
