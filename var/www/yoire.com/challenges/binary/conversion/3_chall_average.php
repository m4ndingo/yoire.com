<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Average"));
print Challenges::header();
?>
Convierte el siguiente texto que est� codificado en binario para obtener la soluci�n a este reto:
<br><br>
<?php
print "O".Encoder::asc2bin("la soluci�n es: muy bien!");

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution("muy bien!");
?>
<!--bla, bla, bla...-->
<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	print "Buen intento, pero esta vez... tendr�s que resolverlo por tu cuenta... ".Smiley::build(";-)");
}
print Website::footer();
?>
