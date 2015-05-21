<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Hexadecimal Chall - Easy"));
print Challenges::header();
?>
Convierte el siguiente texto que está codificado en hexadecimal para obtener la solución a este reto:
<br><br>
<?php
$solution_hex="6e306d317374337279";
print Encoder::asc2hex("la solución es: $solution_hex");

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution(Encoder::hex2asc($solution_hex));
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
