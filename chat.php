<?php
	setcookie("id", $_POST["id"], time()+(60*60*24*7));
	$id = $_POST["id"];
	$pw = $_POST["pw"];
?><!DOCTYPE html>
<html>
<head>
	<title>チャット</title>
	<style>
		h1{
			font-size:32pt;
			position:relative;
			border-top: 2px groove blue;
			border-bottom: 2px ridge blue;
			border-left: 2px groove blue;
			border-right: 2px ridge blue;

			margin :  10px auto;
			width : 500px;
		
			background : blue;
			
			color: aqua;
		}
		form{
			border: 3px dashed pink;
			padding: 10px;
			margin-bottom: 30px;
		}
		.timestamp{
			color: blue;
			font-size: 8pt;
		}
		
		.center{
		text-align: center;
		}

		button{
			position: relative;
   			display: inline-block;
    		padding: 0.25em 0.5em;
    		text-decoration: none;
    		color: white;
    		background: orange;
    		border-radius: 4px;
    		box-shadow: inset 0 2px 0 rgba(255,255,255,0.2), inset 0 -2px 0 rgba(0, 0, 0, 0.05);
    		font-weight: bold;
    		border: solid 2p green;
		}
		
	</style>
</head>
<body>

<h1 class = "center">秘密のチャット</h1>
<form class = "center">
	<?php
		echo $_GET['uname'];
	?>
	<input type="hidden" id="uname" value="<?= $_GET['uname'] ?>">
	<input type="text" id="msg" value = "" placeholder = "コメントを入力" style = "background-color:pink; color:black;">
	<button type="button" id="sbmt">送信</button>
</form>

<div id="chatlog"></div>

<script>
window.onload = function(){
  auth();
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
			
		  	  if( json["head"]["status"] === false ){
				alert("失敗しました");
				return(false);	
			  }
		     getLog();
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
    });
};
function auth(){
  var request = new XMLHttpRequest();
  request.open('POST', 'http://127.0.0.1/chat2/auth.php', false);
  request.onreadystatechange = function(){
    if (request.status === 200 || request.status === 304 ) {
      var response = request.responseText;
      var json     = JSON.parse(response);
      
      if( json["head"]["status"] === false ){
         alert("ログインに失敗しました");
         location.href = "/chat2/";
       }
      else{
         alert("ログインに成功しました");
       }
     }
   };
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(
    	  "id=" + encodeURIComponent("<?php echo $id; ?>") + "&"
    	+ "pw=" + encodeURIComponent("<?php echo $pw; ?>")
  );
}
function getLog(){
	var request = new XMLHttpRequest();	
	request.open('GET', 'http://127.0.0.1/chat2/get.php', false);
	request.onreadystatechange = function(){
		if (request.status === 200 || request.status === 304 ) {
			var response = request.responseText;
			var json     = JSON.parse(response);
			
			if( json["head"]["status"] === false ){
				alert("失敗しました");
				return(false);	
			}
		
			var html="";
			for(i=0; i<json["body"].length; i++){
				html += json["body"][i]["name"] +":"+ json["body"][i]["message"] + "<br>";
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
