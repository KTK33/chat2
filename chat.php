<?php
	setcookie("uname", $_GET["uname"], time()+(60*60*24*7))
?><!DOCTYPE html>
<html>
<head>
	<title>チャット</title>
	<style>
		h1{
			font-size:12pt;
			border-bottom: 1px solid gray;
			color: blue;
		}
		form{
			border: 1px solid gray;
			padding: 10px;
			margin-bottom: 15px;
		}
		.timestamp{
			color: lightgray;
			font-size: 8pt;
		}
	</style>
</head>
<body>

<h1>秘密のチャット</h1>
<form>
	<?php
		echo $_GET['uname'];
	?>
	<input type="hidden" id="uname" value="<?= $_GET['uname'] ?>">
	<input type="text" id="msg">
	<button type="button" id="sbmt">送信</button>
</form>

<div id="chatlog"></div>

<script>
window.onload = function(){
  getLog();
	
  document.querySelector("#sbmt").addEventListener("click",function(){
    var uname = document.querySelector("#uname").value;
    var msg   = document.querySelector("#msg").value;
    var request = new XMLHttpRequest();
    request.open('POST', 'http://127.0.0.1/chat2/set.php', false);
    request.onreadystatechange = function(){
		if (request.status === 200 || request.status === 304 ) {
			var response = request.responseText;
			var json     = JSON.parse(response);
		    if( json["status"] ){
		    	getLog();
		    }
		    else{
		    	alert("書き込みに失敗したよ");
		    }
		}
		else if(request.status >= 500){
			alert("ServerError");
		}
	};
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
    	  "uname=" + encodeURIComponent(uname) + "&"
    	+ "msg="   + encodeURIComponent(msg)
    );
  })
};
function getLog(){
	var request = new XMLHttpRequest();	
	request.open('GET', 'http://127.0.0.1/chat2/get.php', false);
	request.onreadystatechange = function(){
		if (request.status === 200 || request.status === 304 ) {
			var response = request.responseText;
			var json     = JSON.parse(response);
		
			var html="";
			for(i=0; i<json.length; i++){
				html += json[i]["name"] +":"+ json[i]["message"] + "<br>";
			}
			document.querySelector("#chatlog").innerHTML = html;
		}
		else if(request.status >= 500){
			alert("ServerError");
		}
	};
	
	request.onerror = function(e){
		console.log(e);
	};
	
	request.send();
}
</script>
</body>
</html>
