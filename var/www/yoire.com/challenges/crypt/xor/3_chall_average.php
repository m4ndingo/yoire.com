<?php 
include("../../../core.php");
print Website::header(array("title"=>"The XOR Chall - Average"));
print Challenges::header();
?>
Parece que el código fuente ha sido cifrado... ummm... tendrás que averiguar cómo para obtener la respuesta a este reto:
<br><br>
<?php

$key            = "50";
$me             = file_get_contents(__FILE__);
$me_xored       = Crypt::XorData($me,$key);

print Challenges::solutionBox();
print Challenges::checkSolution("c00001");
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?<?=urlencode(Crypt::XorData("showSource",$key))?>">Ver código fuente</a>

<?php
if(Common::getString(Crypt::XorData("showSource",$key))!==false) {
	print "<hr>";
	print $me_xored;
}
print Website::footer();
?>
