<div align=center>
<h2>Retos sin resolver / Unsolved Challeges</b></h2>
<br>
<?php
if(isset($vars["unsolved"])){
?>
<table border=0 cellspacing=0 cellpadding=5 class=rankTable>
<?php
foreach($vars["unsolved"] as $s){
	print "<tr>";
	print "<td>";
	print "<a href='".Config::$base."	challenges/$s'>".$s."</a>";
	print "</td>";
	print "<td>";
	print Challenges::dificulty($s);
	print "</td>";
	print "</tr>".PHP_EOL;
	?>
<?php }?>
</table>
<?php }?>
<?php if(isset($vars["unsolved"]) && !count($vars["unsolved"])){?>
Ninguno ! / None !
<?php }?>
</div>