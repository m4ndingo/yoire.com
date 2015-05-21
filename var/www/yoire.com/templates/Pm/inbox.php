<h2>Inbox</h2>
<?php
if(isset($vars["inbox"])){
?>
<div align=center>
<table border=0 cellspacing=0 cellpadding=5 class=inboxTable style="table-layout: fixed;" width=100%>
<tr><td nowrap class=header width=18%>De / From</td><td class=header>Mensaje / Message</td><td class=header width=20%>Fecha / Date</tr>
<?php
$quote="";
foreach($vars["inbox"] as $m){
	print "<tr>";
	foreach($m as $k=>$v){
		if($k=="id") {
			if($v==Common::getInteger("id")) $quote=$m["msg"]." ( by ".$m["from_u"]." )";
			continue;
		}
		print "<td";
		if($k=="from_u") print " align=right";
		if($k=="date") print " class=small nowrap";
		if($k=="msg") print ' style="word-wrap: break-word"';
		print ">";
		if($k=="from_u") {
			$vo=$v;
			if(strlen($v)>13) $vo=substr($v,0,13)."...";
			print "<a href='?mo=Members&me=ViewProfile&id=".urlencode($v)."'>";
			print Smiley::end(htmlentities(utf8_encode(Smiley::start($vo)),ENT_QUOTES,"utf-8"));;
		}else{
			$v=htmlentities(utf8_encode(Smiley::start($v)),ENT_QUOTES,"utf-8");
			if($k=="msg") $v=preg_replace("/".PHP_EOL."/","<br>",$v);
			print Pm::quote(Smiley::end($v));
		}
		if($k=="login") print "</a>";
		if($k=="msg")   print " [<a href=?mo=Pm&me=send&to=".urlencode($m["from_u"])."&id=".urlencode($m["id"]).">PM</a>]";
		print "</td>";
	}
	print "</tr>".PHP_EOL;
	?>
<?php }?>
<?php if($vars["maxpages"]>0){?>
	<tr>
		<td>
			<?php if($vars["page"]>0){?>
			<a href='?mo=Pm<?=strlen($vars["to"])?"&to=".urlencode($vars["to"]):""?>&page=<?=($vars["page"]-1)?>'>&lt; Ant. / Prev.</a>
			<?php }?>
		</td>
		<td></td>
		<td align=right>
			<?php if($vars["page"]<$vars["maxpages"]){?>
			<a href='?mo=Pm<?=strlen($vars["to"])?"&to=".urlencode($vars["to"]):""?>&page=<?=($vars["page"]+1)?>'>Sig. / Next &gt;</a></td>
			<?php }?>
	</tr>
<?php }?>
</table>
</div>
<?php }?>