<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Identification - Very Easy"));
print Challenges::header();
?>
Convierte el siguiente texto que est� codificado en binario, identifica su contenido, interpretalo, y obt�n la soluci�n:
<br><br>
<?php
$solution=strrev("Se ver led");

print Encoder::asc2bin($solution);

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($solution);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver c�digo fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
