<form method=POST name=frmClass action="?mo=ClassBuilder&me=save">
<table width=500>
<tr>
	<td>Nombre:</td>
	<td><input type=text name=name size=20></td>
</tr>
<tr valign=top>
	<td>Código PHP:</td>
	<td><textarea name=data style=width:100% rows=10></textarea></td>
</tr>
<tr>
	<td colspan=2>
	<input type=submit value=Guardar>
	</td>
</tr>

</table>
</form>
<?=Javascript::focus("frmClass","name")?>