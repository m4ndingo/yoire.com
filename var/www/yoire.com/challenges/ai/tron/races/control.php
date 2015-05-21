<?php 
//die("hacked again.. arf! those PHP shells all likes.. :p");
include("../../../../core.php");
print Website::header(array("title"=>"The AI Chall - Tr0n Races"));
print Challenges::header();
if(Common::getString("action")=="play"){
if (ob_get_level() == 0) ob_start();
ob_flush();
flush();
error_reporting(0);
$code=isset($_POST["code"])?$_POST["code"]:"";
$errors=false;
$templates="templates/Tron/bike_controllers";
$sentCode=false;
if(!strlen($code)) {
	$code=file_get_contents("$templates/player_a.php");
	$code=preg_replace("/^<\?php[\r|\n]+class player_a{[\r|\n]+/","",$code);
	$code=preg_replace("/[\r|\n]*}$/","",$code);
}else{
	$sentCode=true;
	$errors=Tron::checkCode($code);
}
//print md5($code);
?>
<html>
<head>
<style>
input,textarea,body{background:black;color:lime;font-family:courier new;}
</style>
</head>
<body>
<div align=center>
<table border=0 width=100%><tr><td width=100%>
<b>
core.trn: All systems ready...<br>
</b>
||||||||||||||||||||||||||||<br>
This is the new controller for your bike... good luck!<br>
Este es el nuevo controlador para tu moto... buena suerte!<br>
<br>
<form name=frmCode method=POST>
<textarea name=code style='width:100%' rows=30>
<?=$code?>
</textarea>
<input type=submit value=" Jugar / Play ! " style="width:100%;padding:10px">
</form>
<i><b><font color=white>[</font> Available functions / Funciones disponibles <font color=white>]</font></b></i><br>
<font size=-1>
<li>direction() returns current direction, change to a new one with direction([newdir])<br>
<li>getX(), getY() returns X and Y coordinates<br>
<li>collisionDistance() | collisionDistance([anydir]) returns the distance until collision<br>
<i>Note: parameters [*dir] can be empty or one of this values: UP DOWN LEFT or RIGHT</i><br>
</font>
<br>
<i><b><font color=white>[</font> Constants / Constantes <font color=white>]</font></b></i><br>
<font size=-1>
<li>UP DOWN LEFT RIGHT MAX_X MAX_Y<br>
</font>
<br>
<i><b><font color=white>[</font> Rules / Reglas <font color=white>]</font></b></i><br>
<font size=-1>
<li>Try to survive driving your bike and ... / Intenta sobrevivir conduciendo tu moto y...
<li>Don't cross any line / No cruces ninguna línea
<li>or crash with the corners! / o choques con las esquinas!
</font>
<br><br>
<i><b><font color=white>[</font> Mission / Mision <font color=white>]</font></b></i><br>
<font size=-1>
<li>Use well this controller and beat Tr0n 5 consecutive times to score in this game 
<li>Usa bien este controlador y vence a Tr0n 5 veces consecutivas para puntuar en este juego
</font>
</div>
<script>
document.frmCode.code.focus();
</script>
</td><td valign=top>
<?php
if($errors) goto done;

define("UP",0);
define("DOWN",1);
define("LEFT",2);
define("RIGHT",3);
define("MAX_Y",100);
define("MAX_X",100);

class Cell{
	public $x,$y,$value;
	function Cell($x,$y,$value){
		$this->x=$x;
		$this->y=$y;
		$this->value=$value;
	}
}
class globalController{
	public $frame;
	private $cells;
	private $cellUsed;
	public $cDist;
	function globalController(){
		$this->init();
	}
	function init(){
		$this->frame=0;
		$this->cells=array();
		$this->cellUsed=array();
		$this->cDist=array();
	}
	function setCell($x,$y,$id){
		//print "Setting cell ($x,$y)=$id<br>";
		array_push($this->cells,new Cell($x,$y,$id));
		$this->cellUsed["c".$x."d".$y]=1;
	}
	function getCells(){return $this->cells;}
	function isCellEmpty($x,$y){
		return !isset($this->cellUsed["c".$x."d".$y]);
		//print "Checking cell ($x,$y)";
		foreach($this->cells as $c){
			if($c->x==$x && $c->y==$y) return false;
		}
		return true;
	}
	function collisionDistance($x,$y,$direction){
		if(isset($this->cDist[$direction][$x][$y])) return $this->cDist[$this->frame][$direction][$x][$y];
		$min=MAX_X>MAX_Y?MAX_X:MAX_Y;
		if($direction==RIGHT) $min=MAX_X-$x;
		if($direction==LEFT)  $min=$x;
		if($direction==UP)    $min=$y;
		if($direction==DOWN)  $min=MAX_Y-$y;
		foreach($this->getCells() as $c){
			if($c->x!=$x && $c->y!=$y) continue;
			if(($direction==RIGHT || $direction==LEFT) && $c->y!=$y) continue;
			if(($direction==UP    || $direction==DOWN) && $c->x!=$x) continue;
			if($direction==RIGHT){
				if($c->y==$y && $c->x>$x && $c->x-$x<$min) $min=$c->x-$x;
			}
			if($direction==LEFT){
				if($c->y==$y && $c->x<$x && $x-$c->x<$min) $min=$x-$c->x;
			}
			if($direction==DOWN){
				if($c->x==$x && $c->y>$y && $c->y-$y<$min) $min=$c->y-$y;
			}
			if($direction==UP){
				if($c->x==$x && $c->y<$y && $y-$c->y<$min) $min=$y-$c->y;
			}
		}
		//print "(x,y)=($x,$y) direction: ".$direction." min: $min<br>";
		$this->cDist[$this->frame][$direction][$x][$y]=$min;
		return $min;
	}
	function done(){
		$this->frame++;
	}
}

class playerController{
	private $idirection;
	private $x,$y;
	private $id;
	private $gc;
	function playerController($gc,$id,$x,$y,$idirection){
		$this->idirection=$idirection;
		$this->x=intval($x);
		$this->y=intval($y);
		$this->id=$id;
		$this->gc=$gc;
	}
	function collisionDistance($to=-1){
		if($to==-1) $to=$this->idirection;
		return $this->gc->collisionDistance($this->x,$this->y,$to);
	}
	function direction($to=-1){
		if($to==-1)	return $this->idirection;
		$this->idirection=$to;
	}
	function getX() {return $this->x;}
	function getY() {return $this->y;}
	function getId(){return $this->id;}
	function done(){
		if(!$this->alive()) return;
		$this->gc->setCell($this->x,$this->y,$this->id);
		if($this->idirection==UP)   $this->y--;
		if($this->idirection==DOWN) $this->y++;
		if($this->idirection==LEFT) $this->x--;
		if($this->idirection==RIGHT)$this->x++;
		$this->debug();
	}
	function sDir($to){
		if($to==UP)    return "up";
		if($to==DOWN)  return "down";
		if($to==LEFT)  return "left";
		if($to==RIGHT) return "right";
	}
	function alive(){
		if(!$this->gc->isCellEmpty($this->x,$this->y)) {
			//print "Cell (".$this->x.",".$this->y.") is not empty<br>";
			return false;
		}
		if($this->x<0)     return false;
		if($this->y<0)     return false;
		if($this->x>MAX_X) return false;
		if($this->y>MAX_Y) return false;
		return true;
	}
	function debug(){
		return;
		printf("frame %4d, x:%d y:%d direction:%s<br>",$this->gc->frame,$this->x,$this->y,$this->sDir($this->idirection));
	}
}

$nombre_archivo_tmp = tempnam("/tmp", "FOO");
file_put_contents($nombre_archivo_tmp,"<?php class player_a{\n$code\n}");
try{
	include($nombre_archivo_tmp);
}catch(Exception $e){
	print $e->getMessage();
}
if(!$sentCode || md5($code)=="d14f1dc1d12d85e4e1ab0ea1bc3a425a") unlink($nombre_archivo_tmp);
include("$templates/player_d.php");
?>
<table align=center height=80%>
<?php
$p1wins=0;
$p2wins=0;
$gc=new globalController();
for($count=0;$count<5;$count++){
$gc->init();
$init=rand(0,3);
if($init==0){
	$x1=rand(0,MAX_X);
	$y1=0;
	$d1=DOWN;
	$x2=0;
	$y2=rand(0,MAX_Y);
	$d2=RIGHT;
}elseif($init==1){
	$x1=0;
	$y1=rand(0,MAX_Y);
	$d1=RIGHT;
	$x2=rand(0,MAX_X);
	$y2=0;
	$d2=DOWN;
}elseif($init==2){
	$x1=MAX_X;
	$y1=rand(0,MAX_Y);
	$d1=LEFT;
	$x2=rand(0,MAX_X);
	$y2=MAX_Y;
	$d2=UP;
}elseif($init==3){
	$x1=MAX_X;
	$y1=rand(0,MAX_Y);
	$d1=LEFT;
	$x2=rand(0,MAX_X);
	$y2=MAX_Y;
	$d2=UP;
}
$pc1=new playerController($gc,"blue",$x1,$y1,$d1);
$pc2=new playerController($gc,"lime",$x2,$y2,$d2);
$p1=new player_a();
//$p1=new player_b();
//$p1=new player_c();
//$p1=new player_c();
$p2=new player_d();
print "<div align=center><font color=white size=+1>Round ".($count+1)." Starts!</div>";
do{
	$p1->controller($pc1);
	$p2->controller($pc2);
	$pc1->done();
	$pc2->done();
	$gc->done();
}while($pc1->alive() && $pc2->alive() && $gc->frame<10000);
print "<div align=center><font color=white size=+1>Round ".($count+1)." ended. And the winner is...</div>";
print "<tr><td align=center>";
if($gc->frame>=10000){
	print "<font color=white>None!<br>";
}
if(!$pc1->alive()) {
	print "<font color=white><font color='".$pc2->getId()."'><b>Tr0n!</b></font> ;^)</font><br>";
	$p1wins++;
}
if(!$pc2->alive()) {
	print "<font color=white><font color='".$pc1->getId()."'><b>Y0u!</b></font><font color='".$pc2->getId()."'><b> &gt;:-O</b></font></font><br>";
	$p2wins++;
}
?>
<canvas id="canvas<?=$count?>" width=<?=MAX_X?> height=<?=MAX_Y?> style="background:black;display:none"></canvas><img src="" id="img<?=$count?>" width=480 height=480 style='border:solid lime 10px' vspace=10><br>
<script>
var canvas<?=$count?> = document.getElementById("canvas<?=$count?>");
var ctx<?=$count?>    = canvas<?=$count?>.getContext("2d");
ctx<?=$count?>.fillStyle = "black"
ctx<?=$count?>.fillRect( 0, 0, <?=MAX_X?>, <?=MAX_Y?> );

ctx<?=$count?>.fillStyle = "rgba(0,255,0,0.2)"
ctx<?=$count?>.beginPath();
for(i=0;i<<?=MAX_Y?>;i+=parseInt(<?=(MAX_Y/20)?>)){
	ctx<?=$count?>.fillRect( 0, i, <?=MAX_X?>,1 );
}
for(i=0;i<<?=MAX_X?>;i+=parseInt(<?=(MAX_X/20)?>)){
	ctx<?=$count?>.fillRect( i,0, 1,<?=MAX_Y?> );
}
ctx<?=$count?>.stroke();
ctx<?=$count?>.closePath();

function pixel<?=$count?>(x,y,color){
    ctx<?=$count?>.beginPath();
    ctx<?=$count?>.fillStyle = color
	ctx<?=$count?>.fillRect( x, y, 1, 1 );
    ctx<?=$count?>.stroke();
    ctx<?=$count?>.closePath();
    var parameters=canvas<?=$count?>.toDataURL("image/png");
    document.getElementById("img<?=$count?>").src=parameters;
}
<?php
$i=0;
$multiplier=$gc->frame/2000;
foreach($gc->getCells() as $c){
	print "setTimeout(\"pixel".$count."(".$c->x.",".$c->y.",'".$c->value."')\",".($i*$multiplier).");\n";
	ob_flush();
	flush();
	$i++;
}
?>
</script>
<?php
ob_flush();
flush();
if(!$pc1->alive()) break;
}
?>
</td></tr></table>
<div align=center><font color=white>
	<font color='<?=$pc2->getId()?>'><b>Tr0n</b></font> wins <b><?=$p1wins?></b> game(s) - <font color=white><font color='<?=$pc1->getId()?>'><b>Y0u</b></font> win <b><?=$p2wins?></b> game(s)<br>
	<?php
	if($p2wins>=5) {
		print "CONGRATULATIONS!!! You beat Tr0n!!!";
		print Tron::playerWins("races/control",$code);
	}else{
		print "Sorry, You loose ^_^";
	}
	?>
</font></div>
<?php
ob_end_flush();
done:
?>
</td></tr></table>
<?php
}else{
?>
<table>
<tr valign=top>
<td align=center><img src=img/Tron_original-poster-image_crop.jpg height=218 style='margin-right:20'></td>
	<td>
El objetivo de esta misión es ganar a Tr0n en su propio juego: <b>las carreras de motos</b><br><br>
Se te proporcionará un programa (código) funcional para que veas como se controla el vehiculo.<br><br>
Usando tu inteligencia, tendrás que entender su uso y <b>mejorarlo</b>, ya que no es lo suficientemente bueno como para ganar a Tr0n. Tr0n lleva ya bastante tiempo en la parrilla de juegos y es bastante habilidoso :)<br><br>
Cuando venzas a Tr0n un mínimo de 5 veces consecutivas, se te dará por superada esta prueba.<br><br>
Buena suerte!!!
	</td>
	<td align=center><a href="<?=$_SERVER["PHP_SELF"]?>?action=play"><img src=img/tronRaces.png border=0 style='margin-left:20'>
<br><br>
Jugar / Play</a>
</td>
</tr></table>
<?php
}
print Website::footer();
?>
