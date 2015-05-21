<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Hexadecimal Chall - Average"));
print Challenges::header();
?>
Convierte el siguiente texto que está codificado en hexadecimal para obtener la solución a este reto:
<br><br>
<?php

$hidden_file    =file_get_contents(Config::$challsHiddenData."hex_conv_average.file");
$hidden_solution=file_get_contents(Config::$challsHiddenData."hex_conv_average.solution");

print "<div align=center>";
print "<textarea class=terminal_sort>";
print Encoder::data2hex($hidden_file);
print "</textarea>";
print "</div>";

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
