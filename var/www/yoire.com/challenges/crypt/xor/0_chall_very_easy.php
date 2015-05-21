<?php 
include("../../../core.php");
print Website::header(array("title"=>"The XOR Chall - Very Easy"));
print Challenges::header();
?>
Convierte la solución que está cifrada con la clave XOR 10 para obtener la respuesta a este reto:
<br><br>
<?php

$solution_xored="uqci0t~7d0ie0dxy~{";
$key           = "10";
$solution      = Crypt::XorData($solution_xored,$key);

print "La solución es: ".$solution_xored;

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution(Crypt::XorData($solution_xored,$key));
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
