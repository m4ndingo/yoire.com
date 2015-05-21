<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Identification - Average"));
print Challenges::header();
?>
Venga, que tu puedes! <?=Smiley::build(":D")?>
<br><br>
<?php

$solution="Nunca A Mano! XD";

$images=Encoder::asc2bin("La solucion es: ".$solution);

$images=preg_replace("/0/","<img src=img/0.png>",$images);
$images=preg_replace("/1/","<img src=img/1.png>",$images);

print $images;

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($solution);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">¿Quieres ver el código fuente?</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	print Common::Error("No, no! este reto no esta bien... hay imágenes que faltan...");
}
print Website::footer();
?>
