<?php 
include("../../../core.php");
print Website::header(array("title"=>"The XOR Chall - Hard"));
print Challenges::header();
?>
Convierte la solución que está codificada y cifrada con una clave XOR para obtener la respuesta a este reto:
<br><br>
<?php

$sessid             = isset($_COOKIE["PHPSESSID"])?$_COOKIE["PHPSESSID"]:">hi!|m¬_ö_Ó_;m'`ñ·$\"<";
$key                = Encoder::asc2hex($sessid);
$hiddenSolution     = file_get_contents(Config::$challsHiddenData."crypt_xor_average.solution");
$hex_xored_solution = Encoder::data2hex(Crypt::XorData($hiddenSolution,$key));

print "La solucion es: ".$hex_xored_solution;

print "<br><br>";

print Challenges::solutionBox();
print Challenges::checkSolution($hiddenSolution);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
