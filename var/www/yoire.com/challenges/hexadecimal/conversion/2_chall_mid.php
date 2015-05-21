<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Hexadecimal Chall - Mid"));
print Challenges::header();
?>
Convierte el siguiente texto ofuscado para obtener la solución a este reto:
<br><br>
<?php
$solution_offuscated="PeP1TOP PaTO";

$to    =array("1","2","3","4","5","6","7","8","9","0");
$from  =array("1","O","E"," ","a","P","T","e","g","o");

print "la solución en hexadecimal ofuscado es: $solution_offuscated";

$solution=Encoder::hex2asc(Encoder::Transform($solution_offuscated,$from,$to));

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
