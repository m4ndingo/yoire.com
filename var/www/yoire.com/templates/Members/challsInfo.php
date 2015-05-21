<?php
if(isset($vars["solved"])){
?>

<table width=100%><tr valign=top><td>
</td><td nowrap>
<h2>Retos resueltos <?=$vars["pSolved"]?>%</h2>
<table border=0 cellspacing=0 cellpadding=5 class=rankTable>
<?php
foreach($vars["solved"] as $s){
	print "<tr>";
	foreach($s as $k=>$v){
		if($k=="id" || $k=="nick") continue;
		print "<td nowrap>";
		if($k=="name") print "<a href='".Config::$base."challenges/".$v."'>";
		print $v;
		if($k=="name") print "</a>";
		print "</td>";
	}
	print "</tr>".PHP_EOL;
	?>
<?php }?>
</table>
<?php }?>
</td>
<td align=center width=100%>
<?php include("challsLinks.php");?>
</td></tr>
</table>