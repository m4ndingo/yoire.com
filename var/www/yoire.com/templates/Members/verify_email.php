<table align=center>
<tr>
	<td>
	<img src=img/login.png hspace=50>
	</td>
	<td>
	<?=$vars["msg"]?>
	<h3>Verifica tu correo / Verify your e-mail</h3>
	<form method=POST name=frmVerifyEmail action="?mo=Members&me=verifyEmail">
	Correo eléctronico / Email address:<br>
	<input type=text name=email size=40 value="<?=htmlentities($vars["email"])?>" class=n<?=$vars["emailValidated"]?>p> <?=($vars["emailValidated"]?"validado / validated ".Smiley::build(":)"):"sin validar / not validated ".Smiley::build(":|"))?><br>
	<br>
	<input type=submit value="Verificar / Verify">
	<input type=button value="Regresar / Go back" onClick="document.location='<?=Config::$base."?mo=Members"?>'">
	</form>
	</td>
</tr>
</table>
<?=Javascript::focus("frmVerifyEmail","email")?>