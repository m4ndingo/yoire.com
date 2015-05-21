<?php 
include("../../../core.php");
print Website::header(array("title"=>"The XOR Chall - Mid"));
print Challenges::header();
?>
Convierte la solución que está codificada y cifrada con una clave XOR para obtener la respuesta a este reto:
<br><br>
<?php

foreach (
		preg_split("/\./","2.4.10.71.3698") 
		as $something
		) 

$value=pow($something,2);

$key            = dechex($value);
$solution_xored = base64_decode("ucSnos+lo8Oqtw==");
$solution       = Crypt::XorData($solution_xored,$key);

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
