<table align=center>
<tr>
	<td>
	<img src=img/login.png hspace=50>
	</td>
	<td>
	<?=$vars["msg"]?>
	<h3>Acceso / Access</h3>
	<br>
	Ya soy miembro y quiero identificarme... / I'm a member<br><br>
	<form method=POST name=frmLogin action="?mo=Members">
	Usuario / Login / Nickname / Alias:<br>
	<input type=text name=login size=20><br>
	Contrase�a / Password:<br>
	<input type=password name=password size=20 autocomplete="off"><br>
	<input type=submit value="Acceder / Login"> <input type=button value="Resetear contrase�a / Reset password" onClick="document.location='?mo=ResetPassword'">
	<input type=hidden name=action value=login>
	</form>
	<h3>Registro / Register</h3>
	No soy miembro, y quiero registrarme... / I want to register<br><br>
	<form method=POST name=frmRegister action="?mo=Members">
	Usuario / Login / Nickname / Alias:<br>
	<input type=text name=login size=20><br>
	Contrase�a / Password:<br>
	<input type=password name=password size=20 autocomplete="off"><br>
	Repetir Contrase�a / Confirm Password:<br>
	<input type=password name=password_confirm size=20 autocomplete="off"><br>
	Correo / Email: (opcional, pero recomendado si olvidas la contrase�a... / optional, but recomended if you forgot your password)<br>
	<input type=text name=email size=40><br>
	<input type=submit value="Registrarme / Register">
	<input type=hidden name=action value=register>
	</form>
	</td>
</tr>
<tr>
<td></td><td>
<h3>Ventajas de registrarte / Advantages of registering</h3>
<li>Hist�rico de pruebas resueltas / Solved challenges history
<li>Ver perfiles de otros usuario / View other users profiles (#TODO)
<li>Reseteo y cambio de contrase�as / Password reset and change (requiere indicar email / requires email address)
<li>Notificaciones via email / Notifications via email (requiere indicar email / requires email address)
<li>Mensajer�a interna / Internal messages (#TODO)
<br><br>
Consulta la p�gina / Check the page <a href=?mo=Members&me=levelsPage>Niveles / Levels</a> para m�s informaci�n / for more information
</td>
</tr>
</table>
<?=Javascript::focus("frmLogin","login")?>