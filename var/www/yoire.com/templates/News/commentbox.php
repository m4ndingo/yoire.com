<br>
<div align=center>
<h2>Comentar / Comment</h2>
<form name=frmNews action="<?=Config::$base?>?mo=News&me=publishComment&id=<?=$vars["id"]?>" method=POST onSubmit="return check()">
<table>
<tr valign=top>
	<td>Mensaje / Message:<br>
		<textarea name=message id=message class=terminal rows=12 cols=50 style=width:100%></textarea></td>
</tr>
<tr>
	<td colspan=2 align=right><input type=button value="Regresar / Go back" onClick="document.location='<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:"?mo=News"?>'"> <input type=submit value="Publicar / Publish"></td>
</tr>
</table>
</form>
</div>
<script>
function check(){
	var content = document.getElementById("message");
	if(content.value==""){
		alert("Escribe un mensaje, por favor... / Type a message, please...");
		content.focus();
		return false;
	}
	return true;
}
</script>
<?php print Javascript::focus("frmNews","message");?>