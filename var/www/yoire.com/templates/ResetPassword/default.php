<table align=center>
<tr>
	<td>
	<img src=img/login.png hspace=50>
	</td>
	<td>
	<?=$vars["msg"]?>
	<h3>Reseteo de contraseña / Password reset</h3>
	<form method=POST name=frmResetPassword>
	Usuario / Login / Nickname / Alias:<br>
	<input type=text name=login size=20><br>
	<br>
	<input type=submit value="Resetear / Reset"> <input type=button value="Regresar / Go back" onClick="document.location='<?=Config::$base."?mo=Members"?>'">
	</form>
	</td>
</tr>
</table>
<?=Javascript::focus("frmResetPassword","login")?>