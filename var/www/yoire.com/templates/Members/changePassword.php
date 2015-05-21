<table align=center>
<tr>
	<td>
	<img src=img/login.png hspace=50>
	</td>
	<td>
	<?=$vars["msg"]?>
	<h3>Cambia tu Contraseña / Change your Password</h3>
	<form method=POST name=frmChangePassword>
	Nueva Contraseña / New Password:<br>
	<input type=password name=password size=20 autocomplete="off"><br>
	Repetir Contraseña / Repeat Password:<br>
	<input type=password name=password_confirm size=20 autocomplete="off"><br>
	<br>
	<input type=submit value="Cambiar / Change"> <input type=button value="Regresar / Go back" onClick="document.location='<?=Config::$base."?mo=Members"?>'">
	</form>
	</td>
</tr>
</table>
<?=Javascript::focus("frmChangePassword","password")?>