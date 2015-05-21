<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Easy"));
print Challenges::header();
?>
Convierte el siguiente texto que está codificado en binario para obtener la solución a este reto:
<br><br>
<?php
print Encoder::asc2bin("la solución es: muy bien!");

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution("muy bien!");
?>
<!--please, hide this!-->
<!--a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a-->

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
