<table align=center>
<tr>
	<td>
	<img src=img/contact.png hspace=50>
	</td>
	<td>
	<?=$vars["reply"]?>
	<form method=post name=frmContact>
	Tu e-mail / Your e-mail: (opcional, solo si quieres que te respondamos... / optional, nice for replies <?=Smiley::build(":)")?>)<br>
	<input type=text size=40 name=email value="<?php
	if(Session::logged()) print htmlentities(Session::get("email"));
	?>"><br>
	Asunto / Subject:<br>
	<input type=text size=40 name=subject><br>
	Mensaje / Message:<br>
	<textarea name=message rows=10 cols=80></textarea><br>
	<input type=submit value=Enviar>
	</form>
	</td>
</tr>
</table>
<?=Javascript::focus("frmContact","email");?>