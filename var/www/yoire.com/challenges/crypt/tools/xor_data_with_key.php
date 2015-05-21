<?php
include("../../../core.php");
print Website::header(array("title"=>"XOR data with KEY v0.2 - by Mandingo"));
?>
<h2>XOR data with KEY v0.2 - by Mandingo <a href="<?=$_SERVER["PHP_SELF"]?>/..">close [x]</a></h2>
Enter your data here... (Ex.1: ]ofiego*~e*secxo$ieg+*0N) (Ex.2: 57656c636f6d6520746f20796f6972652e636f6d21203a44 with 'Input is Hex')
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?xorme">
<textarea name=data style=width:100% rows=10><?=Common::getString("xorme")===false?"":htmlentities(Common::getPost("data"),ENT_QUOTES,"iso-8859-1")?></textarea>
<br>
Enter your hex KEY here: (Ex.: 0a -&gt; 0x0a hexadecimal == 10 decimal)<br>
0x<input type=text size=64 name=key value="<?=Common::getPost("key")===false?"":urlencode(Common::getPost("key"))?>">
<input type=submit value="XOR Data"> Input is HEX / Entrada es HEX: [<input type=checkbox name=hexInput <?=Common::getPost("hexInput")!==false?"checked":"unchecked"?> value=1>] 'C' Output / Salida 'C': [<input type=checkbox name=cFormat <?=Common::getPost("cFormat")!==false?"checked":"unchecked"?> value=1>]
Descargar resultado / Download result: [<input type=checkbox name=download unchecked value=1>]
</form>
<?php

if(Common::getString("xorme")!==false){
	$data   = Common::getPost("data");
	$key    = Common::getPost("key");
	$cFormat= Common::getPost("cFormat")!==false;
	if(Common::getPost("hexInput")!==false) {
		$data=preg_replace("/\\\x/","",$data);
		$data=preg_replace("/\s/","",$data);
		$data=Encoder::hex2data($data);
	}
	$result = Crypt::XorData($data,$key);
	$result_e=htmlentities($result,ENT_QUOTES,"iso-8859-1");

	print "Result:<br>";
	if(!strlen($result)) print Common::Error("Something failed... or the result is... empty? ".Smiley::build(":p"));
		else print "<textarea class=terminal_sort>".$result_e."</textarea>";
	print "<br>";


	print "Result (Hexadecimal):<br>";
	$result=Encoder::data2hex($result);
	$result2="";
	if($cFormat) $result2=PHP_EOL.PHP_EOL.preg_replace("/(.{2})/","\\x$1",$result);
	print "<textarea class=terminal_sort>".$result.$result2."</textarea>";

	if(Common::getPost("download")!==false) {
		ob_clean();
		header("Content-type: application/force-download");
	    header("Content-Transfer-Encoding: Binary");
		print $result;
		die;
	}
}

print Website::footer();
?>	