<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Base64 Chall - Mid"));
print Challenges::header();
?>
Convierte la soluci�n que est� codificada en base64 para obtener la soluci�n a este reto:
<br><br>
<?php
$solution_b64=Encoder::data2base64(																										
	dechex(
		Encoder::Transform(
			$_SERVER["REMOTE_ADDR"],
			array("."),
			array("")
			)
		)
	);

print "La soluci�n es: ____________".!$solution_b64;

$real_solution=$solution_b64;

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($real_solution);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver c�digo fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
