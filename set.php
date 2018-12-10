<?php
require('lib.php');
$name    = $_POST["uname"];
$message = $_POST["msg"];
$chat = new ChatAPI();
$chat->set($name, $message);

