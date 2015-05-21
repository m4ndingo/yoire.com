<?php
include("../../../core.php");
print Website::header(array("title"=>"Hexadecimal&lt;-&gt;Ascii Converter v0.2 - by Mandingo"));
?>
<h2>Hexadecimal&lt;-&gt;Ascii Converter v0.2 - by Mandingo <a href="<?=$_SERVER["PHP_SELF"]?>/..">close [x]</a></h2>
HexadecimalToAscii Converter (Enter your hexa here... Ej: 77656c636f6d6520746f20796f6972652e636f6d21203a44)
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?hex2asc">
<textarea name=data style=width:100% rows=10><?=Common::getString("hex2asc")===false?"":htmlentities(Common::getPost("data"))?></textarea>
<input type=submit value="Convert Hexadecimal Data"> Force output as UTF-8 ASCII [<input type=checkbox name=ascii <?=(Common::getPost("ascii")||Common::getPost("ascii")=="1")?"checked":""?> value=1>] Decode URL [<input type=checkbox name=urldecode <?=(Common::getPost("urldecode")||Common::getPost("urldecode")=="1")?"checked":""?> value=1>] Descargar resultado / Download result: [<input type=checkbox name=download unchecked value=1>]
</form>
<?php

if(Common::getString("hex2asc")!==false){
	print "Result:<br><br>";
	$data=Common::getPost("data");
	if(Common::getPost("urldecode")){
		$result=htmlentities(urldecode($data));
	}else{
		if(Common::getPost("ascii")){
			$result=htmlentities(utf8_encode(Encoder::hex2asc($data)),ENT_QUOTES,"UTF-8");
		}else{
			$result=Encoder::hex2asc($data,false);
		}
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
AsciiToHexadecimal Converter (UTF-8 inputs accepted)
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?asc2hex">
<textarea name=data style=width:100% rows=10><?=Common::getString("asc2hex")===false?"":htmlentities(Common::getPost("data"),ENT_QUOTES,"iso-8859-1")?></textarea>
<input type=submit value="Convert Ascii to Hexadecimal"> Force input as UTF-8 [<input type=checkbox name=utf8 <?=(Common::getPost("utf8")||Common::getPost("utf8")=="1")?"checked":""?> value=1>]
</form>

<?php

if(Common::getString("asc2hex")!==false){
	print "Result:<br><br>";
	if(!Common::getPost("utf8")){
		print Encoder::data2hex(Common::getPost("data"));
	}else{
		print Encoder::asc2hex(Common::getPost("data"));
	}
	print "<br><br>";
}
print Website::footer();
?>	