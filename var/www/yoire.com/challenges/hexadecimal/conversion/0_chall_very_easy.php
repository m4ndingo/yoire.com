<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Hexadecimal Chall - Very Easy"));
print Challenges::header();
?>
Convierte la soluci�n que est� codificada en hexadecimal para obtener la soluci�n a este reto:
<br><br>
<?php
$solution_hex="7665727973696d706c65";
print "La soluci�n es: ".$solution_hex;

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
