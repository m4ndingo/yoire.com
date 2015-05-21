<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Mid"));
print Challenges::header();
?>
Convierte el siguiente texto que está codificado en binario para obtener la solución a este reto:
<br><br>
<?php
print Encoder::asc2bin("la solución es: who cares!");

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution("who cares!");
?>
<!--do not comment internal functions with HTML tags this time, please!-->
<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
