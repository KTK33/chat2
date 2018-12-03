<?php
require('lib.php');
$name      = $_POST["name"];
$message   = $_POST["message"];

$chat = new ChatAPI();
$chat->set($name,$message);
