<?php
if(isset($vars["messages"])){
?>
<div align=center>
<table border=0 cellspacing=0 cellpadding=5 class=rankTable>
<?php
foreach($vars["messages"] as $m){
	$fg=$m["fg"];
	$bg=$m["bg"];
	if($fg=="FFFFFF" && $fg==$bg) $fg=$bg="";
	print "<tr>";
	foreach($m as $k=>$v){
		if($k=="id" || $k=="date"|| $k=="bg" || $k=="fg") continue;
		print "<td";
		if($k=="message" && (strlen($fg) || strlen($bg))) print " style='color:#$fg;background:#$bg;'";
		if($k=="nick") print " align=right";
		print ">";
		if($k=="nick") {
			$vo=$v;
			if(strlen($v)>13) $vo=substr($v,0,13)."...";
			print "<a href='?mo=Members&me=ViewProfile&id=".urlencode($v)."'>";
			print Smiley::end(htmlentities(utf8_encode(Smiley::start($vo)),ENT_QUOTES,"utf-8"));;
		}else{
			print Smiley::end(htmlentities(utf8_encode(Smiley::start($v)),ENT_QUOTES,"utf-8"));
		}
		if($k=="login") print "</a>";
		print "</td>";
	}
	print "</tr>".PHP_EOL;
	?>
<?php }?>
</table>
</div>
<?php }?>