<div class=level><a href=?mo=Members&me=levelsPage class=clean>Nivel <?=$vars["level"]?></a></div>
<?php
if(isset($vars["solved"])){
?>
<h2>Retos resueltos por / Challeges solved by <b><?=htmlentities($vars["id"])?> (<?=$vars["pSolved"]?>%)</b></h2>
<br>
<?php
if(Rankings::level()<=7){
?>
	<table border=0 cellspacing=0 cellpadding=5 class=rankTable>
	<?php
	foreach($vars["solved"] as $s){
		print "<tr>";
		foreach($s as $k=>$v){
			if($k=="id" || $k=="nick") continue;
			print "<td>";
			if($k=="name") print "<a href='".Config::$base."challenges/".$v."'>";
			print $v;
			if($k=="name") print "</a>";
			print "</td>";
		}
		print "</tr>".PHP_EOL;
		?>
	<?php }?>
	</table>
	<?php if(!count($vars["solved"])) print "Ninguno / None";?>
<?php }else{?>
No tienes suficiente <a href="?mo=Members&me=levelsPage">Nivel</a> para ver esta información, lo sentimos... mínimo requirido N7<br>
You don't have enought <a href="?mo=Members&me=levelsPage">Level</a> to see this information, sorry... minimum required N7
<?php }?>
<?php }?>
</td></tr>
<tr><td>
<br>
<?php include("public_member_info.php")?>
<br>
<?php include("public_member_options.php")?>
</td></tr>
</table>