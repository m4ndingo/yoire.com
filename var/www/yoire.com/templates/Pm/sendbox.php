<div align=center>
<h2>Enviar mensaje privado / Send private message</h2>
<form name=frmPm action="<?=Config::$base?>?mo=Pm&me=send" method=POST>
<table>
<tr>
	<td>Para / To: 
		<select name=nick>
		<?php
			foreach($vars["members"] as $m){
				print "<option value='".urlencode($m["login"])."'";
				if(strlen($vars["to"]) && $vars["to"]==$m["login"]) print " selected";
				print ">";
				print htmlentities($m["login"],ENT_QUOTES,"utf-8")."</option>".PHP_EOL;
			}
		?>
		</select>
	</td>
</tr>
<tr valign=top>
	<td>Mensaje / Message:<br>
		<textarea name=msg id=msg class=terminal rows=12 cols=50><?=strlen($quote)?("{quote}".htmlentities($quote,ENT_QUOTES,"utf-8")."{.quote}").PHP_EOL:""?></textarea></td>
</tr>
<tr>
	<td colspan=2 align=right><input type=button value="Regresar / Go back" onClick="document.location='<?=Config::$base."?mo=Members"?>'"> <input type=submit value="Enviar / Send"></td>
</tr>
</table>
</form>
</div>
<script>
	sendbox=document.getElementById("msg");
	sendbox.scrollTop=sendbox.scrollHeight;
	sendbox.selectionStart = sendbox.selectionEnd = sendbox.value.length;
</script>
<?php if(strlen($vars["to"])) print Javascript::focus("frmPm","msg");?>
<?=$vars["msg"]?>