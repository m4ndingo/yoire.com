<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Hard"));
print Challenges::header();
?>
Convierte el siguiente texto que está codificado en binario para obtener la solución a este reto:
<br><br>
<?php
$bins=Encoder::asc2bin("la solución es: bravo!!");
$bins=Encoder::transform($bins,array("1","0"),array("!","º"));
print $bins;

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution("bravo!!");
?>
<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	print "Buen intento, pero esta vez... tendrás que resolverlo por tu cuenta... ".Smiley::build(";-)");
}
print Website::footer();
?>
