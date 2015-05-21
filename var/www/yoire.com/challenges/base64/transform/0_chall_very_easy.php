<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Base64 Chall - Very Easy"));
print Challenges::header();
?>
Convierte la soluci�n que est� codificada en base64 para obtener la soluci�n a este reto:
<br><br>
<?php
$solution_b64="Z290aXQh";
print "La soluci�n es: ".$solution_b64;

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution(Encoder::base642data($solution_b64));
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver c�digo fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
