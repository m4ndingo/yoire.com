<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Binary Chall - Identification - Hard"));
print Challenges::header();
?>
Lets play a bit with some hardcoded bits, check the source code <?=Smiley::build(";-)");?>
<?php

$fake_solution="1100111010110111010010100101111101111011101101011100100001110011001110010011011011101100011100100010100011011000101011010001000010000000010110101111101001101000";

srand(0); //for me... in this server... the first rand() value after srand(0) gives "1804289383"

for($i=0;$i<strlen($fake_solution);$i++){
	$fake_solution[$i]=$fake_solution[$i]^(rand()%2);
}

$solution=Encoder::bin2asc($fake_solution);

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
