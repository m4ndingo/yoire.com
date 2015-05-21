<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Crackme Chall - Stage 3 - Ep1c"));
print Challenges::header();
?>
Descarga y analiza el ejecutable (PE) suministrado, e indica la solución en el recuadro de texto mostrado más a abajo:
<br><br>
<?php

$solution="a bit harder";

print "<table class=terminal><tr><td align=center>";
print "<a href=".dirname($_SERVER["PHP_SELF"])."/support_files/04_crackme_stage3_Ep1c.exe><img src=img/v.png border=0 width=128><br>";
print "04_crackme_stage3_Ep1c.exe</a>";
print "</td></tr>";
print "</table>";
print "<br><br>";

print Challenges::solutionBox();
print Challenges::checkSolution($solution);

print Website::footer();
?>
