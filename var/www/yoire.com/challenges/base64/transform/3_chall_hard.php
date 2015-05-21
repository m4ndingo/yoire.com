<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Base64 Chall - Hard"));
print Challenges::header();
?>
Introduce la soluci�n de este c�digo / script en base64 para superar a este reto:
<br><br>
<?php
$utf8=false;

$solution_file  = file_get_contents(Config::$base."img/v/nice_yoire_xxed_by_Mawekl.jpg");
$solution_bytes = substr($solution_file,0,4);
$solution_b64   = Encoder::data2base64($solution_bytes,$utf8);

print "La soluci�n es: [GUESS ME!]"; // sorry, I mean $solution_b64 X"DDD

print "<br><br>";
print Challenges::solutionBox();
print Challenges::checkSolution($solution_b64);
?>
<a href="<?=$_SERVER["PHP_SELF"]?>?showSource">Ver c�digo fuente</a>

<?php
if(Common::getString("showSource")!==false) {
	print "<hr>";
	highlight_file(__FILE__);
}
print Website::footer();
?>
