<div align=center>
<h2>Usuarios Activos las últimas 24h / 24h of Last Active Users</h2>
<br>
<?php
if(isset($vars["activeUsers"]) && count($vars["activeUsers"])){
?>
<table border=0 cellspacing=0 cellpadding=5 class=onlineTable>
<tr><td align=center><b>Nick</b></td><td><b>Módule</b></td><td><b>Was online...</b></td></tr>
<?php
foreach($vars["activeUsers"] as $u){
	print "<tr>";
	foreach($u as $k=>$v){
		if($k=="id" || $k=="script") continue;
		print "<td nowrap";
		if($k=="nick") print " align=center";
		print ">";
		switch($k){
			case "time":
				print Misc::dateDiff(time()+1, $v, 6)." ago...";
				break;
			case "module":
				$v=preg_replace("/<.*/","",$v);
				if($v=="") print $u["script"]; else
					print $v;
				break;
			case "nick":
				if($v=="") print "Anonymous";
					else print "<a href='?mo=Members&me=ViewProfile&id=".urlencode($v)."'>".htmlentities($v)."</a>";
				break;
			default:
				print $v;
		}
		print "</td>";
	}
	print "</tr>".PHP_EOL;
	?>
<?php }?>
</table>
<?php }?>
</div>