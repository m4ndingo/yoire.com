<table align=center border=0>
<tr>
<td align=center>
	<img src=img/v.png hspace=50><br>
	Tu IP es / Your IP is :
</td>
<td>
	<div class=level><a href=?mo=Members&me=levelsPage class=clean>Nivel <?=Rankings::level()?></a></div>
	<a href=?mo=News>News</a> | <a href=?mo=Shoutbox>Shoutbox / Griterio</a> | <a href=?mo=Pm title='Mensajes Privados / Private Messages'>Pm</a> | <a href=?mo=Canvas>Canvas</a> | <a href=?mo=Chat>Chat</a>| <a href=?mo=Online>24h</a><br>
	<br>
	<a href=?mo=Members&me=verifyEmail>Verificar correo / Verify e-mail</a>
	(<?=(Session::get("emailValidated")?"validado / validated ".Smiley::build(":)"):"sin validar / not validated ".Smiley::build(":|"))?>)
	<br><br>
	<a href=?mo=Members&me=changePassword>Cambiar la contraseña / Change password</a>
	<br><br>
	<a href=?mo=Members&me=logout>Cerrar la sesion / Close session</a>
</td>
</tr>
<td colspan=2><font size=-1><?=Encoder::asc2bin($_SERVER["REMOTE_ADDR"])?></font></td>
</tr><tr><td></td>
</tr>
<tr valign=top><td colspan=2>
<?php include("challsInfo.php");?>
</td></tr></table>
