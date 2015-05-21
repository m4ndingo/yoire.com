<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Crackme Chall - Very Hard"));
print Challenges::header();
?>
Descarga y analiza el ejecutable (PE) suministrado, e indica la solución en el recuadro de texto mostrado más a abajo:
<br><br>
<?php

print "<table class=terminal><tr><td align=center>";
print "<a href=".dirname($_SERVER["PHP_SELF"])."/support_files/05_crackme_very_hard.exe><img src=img/v.png border=0 width=128><br>";
print "05_crackme_very_hard.exe</a>";
print "</td></tr>";
print "</table>";
print "<br><br>";

print Challenges::solutionBox();
print checkSolution();

print Website::footer();

function isValidChecksum($solution){
	//2*2*3*5*5*7*7*7*7
	$two   = substr_count($solution,"2");
	$three = substr_count($solution,"3");
	$five  = substr_count($solution,"5");
	$seven = substr_count($solution,"7");
	if ($two==2 && $three==1 && $five==2 && $seven==4) return true;
	$four  = substr_count($solution,"4");
	if ($four==1 && $three==1 && $five==2 && $seven==4) return true;
	$six  = substr_count($solution,"6");
	if ($two==1 && $six==1 && $five==2 && $seven==4) return true;
	return false;
}
function checkSolution(){
	$solution=Common::getPost("solution");
	if($solution=="") return;
	$id=Challenges::getChallId();

	if(isValidChecksum($solution)){
		$okMsg="La solución es correcta / The solution is correct ".Smiley::build(":-D")." ";
		if(!Session::logged()) $okMsg.="<a href=?mo=Members target=_top>Logeate</a>";
			else {
				$okMsg.="<a href=?mo=Website target=_top>Inicio</a> | <a href=?mo=Contact target=_top>Contacto</a> | <a href=?mo=Members target=_top>Tu perfil</a> | <a href=?mo=Challenges target=_top>Challenges</a> (<a href='".Config::$base."' target=_top>Random Probe</a>)";
				$okMsg.=Rankings::rank($id);
			}
		return Common::Info($okMsg,"center");
	}
	Challenges::onInvalidSolution($id);
	return Common::Info("La solución es incorrecta / The solution is incorrect ".Smiley::build(":-("));
}

?>
