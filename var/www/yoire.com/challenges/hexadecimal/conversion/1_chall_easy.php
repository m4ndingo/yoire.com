<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Hexadecimal Chall - Easy"));
print Challenges::header();
?>
Convierte el siguiente texto que est� codificado en hexadecimal para obtener la soluci�n a este reto:
<br><br>
<?php
$solution_hex="6e306d317374337279";
print Encoder::asc2hex("la soluci�n es: $solution_hex");

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution(Encoder::hex2asc($solution_hex));
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver c�digo fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
