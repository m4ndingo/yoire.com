<canvas id="canvas" style="cursor:crosshair;background:none"></canvas>
<canvas id="shared" style="cursor:none;background:#111"></canvas>
<script>
var oldX,oldY,newX,newY,draw,color,width;
var newdata;
newdata=false;
draw=false;
color="rgb("+Math.round(Math.random()*256)+","+Math.round(Math.random()*256)+","+Math.round(Math.random()*256)+")";
width=10+Math.round(Math.random()*40);

//user canvas
var canvas;
var canvas = document.getElementById("canvas");
var ctx    = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight-60;
canvas.style.left = "0px";
canvas.style.top = "60px";
canvas.style.position = "absolute";
canvas.style.background = "none";

canvas.addEventListener("mousedown",function(e){action("down",e)},false);
canvas.addEventListener("mouseup",	function(e){action("up"  ,e)},false);
canvas.addEventListener("mouseout", function(e){action("up"  ,e)},false);
canvas.addEventListener("mousemove",function(e){action("move"  ,e)},false);
canvas.oncontextmenu =				function(e){action("rclick",e);return false;};

//shared canvas
var shared;
var shared     = document.getElementById("shared");
var shared_ctx = shared.getContext("2d");

shared.width = canvas.width;
shared.height = canvas.height;
shared.style.left = canvas.style.left;
shared.style.top = canvas.style.top;
shared.style.position = canvas.style.position;
shared.style.zIndex=-1;

function action(act,e){
	if(e.button==2) return menu();
	oldX=newX;
	oldY=newY;
    newX = e.clientX - canvas.offsetLeft;
	newY = e.clientY - canvas.offsetTop;
	if(act=="down") draw=true;
	if(act=="up")   draw=false;
	if(act=="move" && draw) ddraw();
}
function menu(){
	draw=false;
	var op;
	op=prompt("Options:\n\n1 - Change color (current "+color+")\n2 - Change width (current "+width+")\n3 - Save drawing\n\n");
	if(op=="1") color=prompt("New rgb color?",color);
	if(op=="2") width=prompt("New drawing width?",width);
	if(op=="3") save =prompt("Save drawing? (y/n)","y");
	
	if(save=="y") saveCanvas(true);
}

var timer;

function ddraw(){
	clearTimeout(timer);
	ctx.beginPath();
	ctx.strokeStyle = color;
	ctx.lineWidth = width;
	ctx.moveTo(oldX, oldY);
	ctx.lineTo(newX, newY);
	ctx.stroke();
	ctx.closePath();
	newdata=true;
	autoSave();
}

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
var oldTitle=document.title;
var mypostrequest=new ajaxRequest()
function saveCanvas(confirm){
	if(draw || !newdata){
		autoSave();
		return;
	}
	newdata=false;
//	refreshShared();
	document.title ="Saving...";
	mypostrequest.onreadystatechange=function(){

	 if (mypostrequest.readyState==4){    
	  if (mypostrequest.status==200 || window.location.href.indexOf("http")==-1){
			if(confirm) alert("Saved!");
			document.title =oldTitle;
//			refreshShared();
			autoSave();
	  }
	  else{
	   alert("An error has occured making the request")
	  }
	 }
	}
	var parameters="data="+encodeURIComponent(canvas.toDataURL("image/png"));
	mypostrequest.open("POST", "<?=Config::$base?>?mo=Canvas&me=save", true)
	mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	mypostrequest.send(parameters);
}

function autoSave(){
	timer=setTimeout(function(){saveCanvas(false)},5000);
}

function autoRefresh(){
	timer_r=setTimeout(function(){refreshShared()},5000);
}

autoSave();

refreshShared();
autoRefresh();

function refreshShared(){
	var img = new Image;
	img.onload = function(){
    	//ctx.fillStyle = "none";
		//ctx.clearRect(0,0,canvas.width,canvas.height);
		shared_ctx.drawImage(img,0,0);
		autoRefresh();
	};
	img.src = "img/canvas.jpg?" + new Date().getTime();;
}
</script>

