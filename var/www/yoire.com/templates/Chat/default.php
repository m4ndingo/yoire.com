<h2>Live Chat</h2>
<form name=frmChat onsubmit="return false;">
<textarea style="width:100%" id=chat rows=10 class=terminal_chat></textarea>
<input type=text size=40 name=data onKeyPress=writing() style="width:100%;height:20px" autocomplete="off" class=terminal onMouseDown="document.title=oldTitle">
</form>
<script>

var oldTitle=document.title;
var isActive=true;
var timer;

window.onfocus = function () { isActive = true; }; 
window.onblur  = function () { isActive = false; }; 

function writing(e)
{
     var key;
	 autoRefresh();
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox      

     if (key == 13) send();
	 return false;
}


var timer;

function ajaxRequest(){
 var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
 if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
  for (var i=0; i<activexmodes.length; i++){
   try{
    return new ActiveXObject(activexmodes[i])
   }
   catch(e){
    //suppress error
   }
  }
 }
 else if (window.XMLHttpRequest) // if Mozilla, Safari etc
  return new XMLHttpRequest()
 else
  return false
}
var sending=false;
var mypostrequest=new ajaxRequest()

var cached="";

function send(){
	if(sending) return;
	sending=true;	
	var msg=document.frmChat.data.value;
	chat=document.getElementById("chat");
	cached+=msg+"\r\n";
	document.frmChat.data.value="";
	document.frmChat.data.focus();
	document.title ="Sending...";
	mypostrequest.onreadystatechange=function(){
	 if (mypostrequest.readyState==4){    
	  if (mypostrequest.status==200 || window.location.href.indexOf("http")==-1){
			document.title=oldTitle;
			sending=false;
			chat.value+="sending... "+cached;
			chat.scrollTop=chat.scrollHeight;
			cached="";
			autoRefresh();
	 }
	  else{
	   alert("An error has occured making the request")
	  }
	 }
	}
	var parameters="data="+encodeURIComponent(msg);
	mypostrequest.open("POST", "<?=Config::$base?>?mo=Chat&me=send", true)
	mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	mypostrequest.send(parameters);
}

function autoRefresh(){
	clearTimeout(timer);
	timer=setTimeout(function(){refreshChat()},5000);
}

var refreshing=false;
var lastUpdated="";

refreshChat();
autoRefresh();


function refreshChat(){
	if(refreshing) return;
	refreshing=true;
	var check = new XMLHttpRequest();
	check.open('GET', '<?=Config::$base?>?mo=Chat&me=updated');
	check.onreadystatechange = function() {		
		//console.log("checking "+lastUpdated);
		if(check.responseText=="" || check.responseText==lastUpdated){
			refreshing=false;
			autoRefresh();
			return;
		}
		lastUpdated=check.responseText;
		//console.log("updated "+lastUpdated);
		var client = new ajaxRequest();
		client.open('GET', '<?=Config::$base?>?mo=Chat&me=log');
		client.onreadystatechange = function() {
			chat=document.getElementById("chat");
			chat.value=client.responseText;
			chat.scrollTop=chat.scrollHeight;
			if(!isActive) document.title="New message";
			refreshing=false;
			autoRefresh();
		}
		client.send();
	}
	check.send();
}

document.frmChat.data.focus();
</script>
