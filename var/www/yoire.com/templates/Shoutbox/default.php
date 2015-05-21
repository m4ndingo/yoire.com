<script type="text/javascript" src="js/jscolor/jscolor.js"></script>
<script>
function updateBG(value){document.getElementById("message").style.background=value};
function updateFG(value){document.getElementById("message").style.color     =value};
</script>
<div align=center>
<h2>Shoutbox / Griterio</h2>
<form method=POST name=frmShout>
Mensaje / Message : <input type=text size=30 maxlength=128 name=message id=message> 
<?php
if(Rankings::level()<=8){
?>
Texto: <input type=text name=fg class=color size=4 onChange="updateFG(this.value)" value="CACAFE">
Fondo: <input type=text name=bg class=color size=4 onChange="updateBG(this.value)" value="313373">
<?php }?>
<input type=submit value="Send / Enviar">
</form>
<?=$vars["resp"]?>
<?php
include("shoutbox_messages.php");
?>
</div>
<?=Javascript::focus("frmShout","message");?>
<?php
if(Rankings::level()<=8){
?>
<script>
	updateBG("#313373");
	updateFG("#CACAFE");
</script>
<?php }?>