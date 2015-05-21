<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Base64 Chall - Very Hard"));
print Challenges::header();
?>
Convierte este base64 en algo útil si quieres resolver este reto:
<br><br>
<?php
$utf8=false;

$hidden_file    =file_get_contents(Config::$challsHiddenData."base64_transform_very_hard");
$hidden_solution=file_get_contents(Config::$challsHiddenData."base64_transform_very_hard.solution");

print "<textarea class=terminal_sort>";
print Encoder::data2base64($hidden_file,$utf8);
print "</textarea>";

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($hidden_solution);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver código fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
