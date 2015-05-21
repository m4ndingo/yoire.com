<table border=0 cellspacing=0 cellpadding=5 class=inboxTable style="table-layout: fixed;" width=100%>
<tr><td>
<?php
if(count($vars["comments"])){
?>
	<table border=0 cellspacing=0 cellpadding=5 class=inboxTable style="table-layout: fixed;" width=100%>
	<tr><td nowrap class=header width=18%>De / From</td><td class=header>Mensaje / Message</td><td class=header width=30%>Cuando / When</tr>
	<?php 
	foreach($vars["comments"] as $c){?>
		<tr>
		<td><?php
				$vo=$c["from_u"];
				if(strlen($c["from_u"])>13) $vo=substr($c["from_u"],0,13)."...";
				print "<a href='?mo=Members&me=ViewProfile&id=".urlencode($c["from_u"])."'>";
				print Smiley::end(htmlentities(utf8_encode(Smiley::start($vo)),ENT_QUOTES,"utf-8"));
		?>
		</td>
		<td><?php
			$content=$c["message"];
			$content=trim($content);
			$content=htmlentities($content,ENT_QUOTES,"iso-8859-1");
			$content=preg_replace("/".PHP_EOL."/","<br>",$content);
			print $content;		
		?></td>
		<td><font color=#0a0><?=Misc::dateDiff(time()+1, $c["date"], 2)?> ago...</font></td>
		</tr>
	<?php }?>
	</table>
	<br>
<?php }?>
<div style="color:#fff;word-wrap:break-word">
<?=$vars["title"]?>
<?php
print "<br>".PHP_EOL;
for($i=0;$i<strlen($vars["title"]);$i++) print "=";
print "<br>".PHP_EOL.PHP_EOL;
?>
<?php
$content=$vars["content"];
$content=trim($content);
$content=htmlentities($content,ENT_QUOTES,"iso-8859-1");
$content=preg_replace("/".PHP_EOL."/","<br>",$content);
print $content;
?>
<?php
$footer="Source: yoire.com - Date: ".date("F j, Y, g:i a",$vars["date"])." - Published by: ".$vars["from_u"];
print "<br>".PHP_EOL;
for($i=0;$i<strlen($footer);$i++) print "_";
print "<br>".PHP_EOL;
print $footer;
?>
</div>
</td></tr>
</table>