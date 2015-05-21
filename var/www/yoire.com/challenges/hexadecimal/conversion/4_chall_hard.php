<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Hexadecimal Chall - Hard"));
print Challenges::header();
?>
Comprende lo que hace este script, junto con los siguientes datos, para obtener la solución a este reto:
<br><br>
<?php

$solution_hash_data="ßŸ|?Ür›AuŽøÛµ(";

print $solution_hash_data;

$you_sent           = Common::getPost("solution");
$you_sent_hash      = md5($you_sent);
$you_sent_hash_data = Encoder::hex2data($you_sent_hash);

$_POST["solution"]  = $you_sent_hash_data;	//let's override your text solution with this computed data...

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($solution_hash_data);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
