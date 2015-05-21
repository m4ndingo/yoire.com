<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
	<td><select name=section class=terminal_auto style='font-size:18px;font-weight:bold;padding:0;border-bottom:0px;color:#eee' onChange=document.location='?mo=News&section='+this.value><?php
	foreach($vars["sections"] as $s){
		print "<option value=".urlencode($s);
		if($vars["section"]==$s) print " selected";
		print ">";
		print htmlentities($s);
		print "</option>";
	}
	?>
	</select>
	</td>
	<td align=right><h2>Noticias / News</h2></td>
</tr>
</table>
<?php
if(isset($vars["news"])){
?>
<div align=center>
<table border=0 cellspacing=0 cellpadding=5 class=inboxTable style="table-layout: fixed;" width=100%>
<?php
$quote="";
if(is_array($vars["news"])){
	foreach($vars["news"] as $m){
		print "<tr><td>";
		$hash=$m["id"];
		$source_domain="";
		if(preg_match("/^https?:\/\/([^\/]+)/",$m["source"],$d)) $source_domain=htmlentities($d[1]);
		if(strlen($m["content"])){
			print "<a href=\"javascript:showC('$hash')\" class=clean style=color:#0f0>";
		}elseif(strlen($source_domain)){
			$source=preg_replace("/\"/",urlencode('"'),$m["source"]);
			print "<a href=\"".$source."\" class=clean style=color:#0f0 target=_blank>";
		}
		print htmlentities($m["title"],ENT_QUOTES,"iso-8859-1")."</a>";
		if(strlen($source_domain)){
			$s=$m["source"];
			print " ( ";
			print $source_domain;
			print " )";
		}
		print "<br>".PHP_EOL;
		print "<font color=#0a0>sent ".Misc::dateDiff(time()+1, $m["date"], 6)." ago...</font>".PHP_EOL;
		print " <font color=#0a0>by ";
		print "<a href='?mo=Members&me=ViewProfile&id=".urlencode($m["from_u"])."' target=_new>";
		print htmlentities($m["from_u"])."</a></font><br>".PHP_EOL;
		if(strlen($m["content"])){
			$content=trim($m["content"]);
			$content=htmlentities($content,ENT_QUOTES,"iso-8859-1");
			//$content=preg_replace("/".PHP_EOL."/","<br>",$content);
			print "<div id='$hash' style='color:#fff;display:none;word-wrap:break-word;white-space:pre-wrap;'><br>";
			print $content."<br>";
			$source=$m["source"];
			$source=preg_replace("/\"/",urlencode('"'),$source);
			if(strlen($source_domain)) print "<br>Link: <a href=\"".$source."\">".htmlentities($m["source"])."</a><br>";
			//print "<br>".PHP_EOL;
			print PHP_EOL;
			print "</div>".PHP_EOL;
		}
		print "<a href=?mo=News&me=comment&id=".$m["id"]." class=clean>";
		if(!count($m["comments"])) 
			print "comentar / comment";
		else
			print "comments (".count($m["comments"]).")";
		print "</a>";
		print " | <a href=?mo=News&me=raw&id=".$m["id"]." target=_new title='open raw article in a new window'>raw</a>";
		print "</td></tr>".PHP_EOL;
		?>
	<?php }
}	
?>
<?php if($vars["maxpages"]>0){?>
	<tr>
		<td align=right>
			<?php if($vars["page"]>0){?>
			<a href='?mo=News<?=strlen($vars["section"])?"&section=".urlencode($vars["section"]):""?>&page=<?=($vars["page"]-1)?>'>&lt; Ant. / Prev.</a>
			<?php }?>
			<?php if($vars["page"]<$vars["maxpages"]){?>
			<a href='?mo=News<?=strlen($vars["section"])?"&section=".urlencode($vars["section"]):""?>&page=<?=($vars["page"]+1)?>'>Sig. / Next &gt;</a>
			<?php }?>
		</td>
	</tr>
<?php }?>
</table>
</div>
<?php }?>
