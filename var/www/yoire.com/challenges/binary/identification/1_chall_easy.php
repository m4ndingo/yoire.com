<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Identification - Easy"));
print Challenges::header();
?>
Convierte el siguiente texto que está codificado en binario, identifica su contenido, interpretalo, y obtén la solución:
<br><br>
<?php
$you_see="La solucion no es: masaje";
$partial_solution=preg_replace(array("/a/","/je/","/no/"),array("e","ta",""),$you_see);

print Encoder::asc2bin($you_see);

$solution=preg_replace("/.*?: /","",$partial_solution);

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($solution);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
