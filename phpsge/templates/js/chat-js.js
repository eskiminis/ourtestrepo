//chat ajax

var request = null;
if(window.XMLHttpRequest){
	request = new XMLHttpRequest();
} else if(window.ActiveXObject){
	request = new ActiveXObject("Microsoft.XMLHTTP");
}

function chat_rel(){
	if(request){
		request.open("POST","frchat.php");
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset = UTF-8");
		
		request.onreadystatechange = function(){
			if(request.readyState==4){
				document.getElementById("chatlog").innerHTML = request.responseText;
			}
		}
		var str_sendr = "act=chat_rel";
		request.send(str_sendr);
		setTimeout("chat_rel();",5000);
	} else {alert("Ajax Eror!");}
}

function chat_sendm(){
	request.open("POST","frchat.php");
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset = UTF-8");
	
	request.onreadystatechange = function(){
		if(request.readyState==4){
			chat_rel();
		}
	}
	
	var str_sendr = "act=chat_sendm&msg=" + document.getElementById("msg").innerHTML;
	request.send(str_sendr);
}