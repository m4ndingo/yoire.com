<br>
<div align=center>
<h2>Publicar / Publish</h2>
<form name=frmNews action="<?=Config::$base?>?mo=News&me=publish" method=POST onSubmit="return check()">
<table>
<tr valign=top>
	<td>Título / Title:<br>
		<input type=text name=title id=title class=terminal style="width:100%"></td>
</tr>
<tr valign=top>
	<td>Fuente original (enlace) / Original source (link):<br>
		<input type=text name=source id=source class=terminal style="width:100%" value="http://" onClick='if(this.value=="http://") this.value=""' onBlur='if(this.value=="") this.value="http://"'></td>
</tr>
<tr valign=top>
	<td>Contenido opcional / Optional content:<br>
		<textarea name=content id=content class=terminal rows=12 cols=50 style=width:100%></textarea></td>
</tr>
<tr>
	<td colspan=2 align=right><input type=button value="Regresar / Go back" onClick="document.location='<?=Config::$base."?mo=Members"?>'"> <input type=submit value="Publicar / Publish"></td>
</tr>
<tr>
	<td>Sección / Section: <font size=-1>(allowed chars: a-z0-9,!&amp; and space)</font>
		<input type=text name=section id=section class=terminal style="width:100%" value="security"></td>
	</td>
</tr>
</table>
</form>
</div>
<script>
function check(){
	var title=document.getElementById("title");
	if(title.value==""){
		alert("Indica un título, por favor... / Provide a title, please...");
		title.focus();
		return false;
	}
	var source  = document.getElementById("source");
	var content = document.getElementById("content");
	if(content.value=="" && source.value=="http://"){
		alert("Añade un enlace o contenido, por favor... / Add a link or content, please...");
		source.focus();
		return false;
	}
	return true;
}
function showC(id){
	var c=document.getElementById(id);
	c.style.display=c.style.display=="none"?"block":"none";
}
</script>
<?php print Javascript::focus("frmNews","title");?>
<?=$vars["msg"]?>