<?php 
include("../../../core.php");
print Website::header(array("title"=>"The Crackme Chall - Stage 2 - Easy"));
print Challenges::header();
?>
Descarga y analiza el ejecutable (PE) suministrado, e indica la soluci�n en el recuadro de texto mostrado m�s a abajo:
<br><br>
<?php

$solution="SURPRISE!!!:)";

print "<table class=terminal><tr><td align=center>";
print "<a href=".dirname($_SERVER["PHP_SELF"])."/support_files/02_crackme_stage2_easy.exe><img src=img/v.png border=0 width=128><br>";
print "02_crackme_stage2_easy.exe</a>";
print "</td></tr>";
print "</table>";
print "<br><br>";

print Challenges::solutionBox();
print Challenges::checkSolution($solution);

print Website::footer();
?>
