<?php
include("../../../core.php");
print Website::header(array("title"=>"Base64&lt;-&gt;Ascii Converter v0.1 - by Mandingo"));
?>
<h2>Base64&lt;-&gt;Ascii Converter v0.2 - by Mandingo <a href="<?=$_SERVER["PHP_SELF"]?>/..">close [x]</a></h2>
Base64ToAscii Converter (Enter your base here... Ej: V2VsY29tZSB0byB5b2lyZS5jb20hIDpE)
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?base642data">
<textarea name=data style=width:100% rows=10><?=Common::getString("base642data")===false?"":htmlentities(Common::getPost("data"))?></textarea>
<input type=submit value="Convert Base64 Data"> Force output as UTF-8 ASCII [<input type=checkbox name=utf8 <?=(Common::getPost("utf8")||Common::getPost("utf8")=="1")?"checked":""?> value=1>] Descargar resultado / Download result: [<input type=checkbox name=download unchecked value=1>]
</form>
<?php

if(Common::getString("base642data")!==false){
	print "Result:<br><br>";
	if(Common::getPost("utf8")){
		$result=htmlentities(Encoder::base642data(Common::getPost("data"),true),ENT_QUOTES,"UTF-8");
	}else{
		$result=Encoder::base642data(Common::getPost("data"),false);
	}
	if(!strlen($result)) print Common::Error("Something failed... or the result is... empty? ".Smiley::build(":p"));
		else print "<pre class=terminal_auto>".$result."</pre>";
	print "<br>";

	if(Common::getPost("download")!==false) {
		ob_clean();
		header("Content-type: application/force-download");
	    header("Content-Transfer-Encoding: Binary");
		print $result;
		die;
	}
}
?>
<br>
AsciiToBase64 Converter (UTF-8 inputs accepted)
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?data2base64">
<textarea name=data style=width:100% rows=10><?=Common::getString("data2base64")===false?"":htmlentities(Common::getPost("data"),ENT_QUOTES,"iso-8859-1")?></textarea>
<input type=submit value="Convert Ascii to Base64"> Force input as UTF-8 [<input type=checkbox name=utf8 <?=(Common::getPost("utf8")||Common::getPost("utf8")=="1")?"checked":""?> value=1>]
</form>

<?php

if(Common::getString("data2base64")!==false){
	print "Result:<br><br>";
	if(!Common::getPost("utf8")){
		print Encoder::data2base64(Common::getPost("data"),false);
	}else{
		print Encoder::data2base64(Common::getPost("data"),true);
	}
	print "<br><br>";
}
print Website::footer();
?>	