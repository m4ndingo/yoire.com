<html>
<head>
	<title><?=$vars["title"]?></title>
	<base href="<?php print Config::$base?>">
	<link rel="stylesheet" type="text/css" href="css/default.css"/>
</head>
<body>
<div class=header id=header>
<table border=0 align=center><tr>
<td><a href="?mo=Website" class=clean>Inicio</a></td>
<td>|</td>
<td><a href="?mo=Contact" class=clean>Contacto</a></td>
<?php
if(!Session::logged()){?>
<td>|</td>
<td><a href="?mo=Members" class=clean>Miembros</a></td>
<?php }?>
<?php
if(Session::logged()){?>
<td>|</td>
<td align=right><?php
print "Bienvenido<b><a href='?mo=Members'><img src=img/v_small.png align=absmiddle border=0 hspace=5>".Session::get("login")."</a></b>";
?></td>
<?php }?>
<td>|</td>
<td><a href="https://docs.google.com/document/d/1ftqQ3rzZh-SWBPxIQ3qIYtpC06bvU6najOGjkY9H5Fs/edit?usp=sharing" class=clean target=_new>Roadmap</a></td>
<td>|</td>
<td><a href="challenges" class=clean>Challenges</a> (<a href="<?=Config::$base?>" class=clean>Random Probe</a>)</td>
<?php
if(Session::get("newPMs")=="1"){
?>
<td><a href="?mo=Pm" class=clean><img src=img/pm.gif border=0 hspace=10 title="Nuevos mensajes / New messages" align=absmiddle></a></td>
<?php }?>
</table>
</div>