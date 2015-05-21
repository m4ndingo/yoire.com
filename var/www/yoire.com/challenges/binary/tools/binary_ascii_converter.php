<?php
include("../../../core.php");
print Website::header(array("title"=>"Binary&lt;-&gt;Ascii Converter v0.1 - by Mandingo"));
?>
<h2>Binary&lt;-&gt;Ascii Converter v0.1 - by Mandingo <a href="<?=$_SERVER["PHP_SELF"]?>/..">close [x]</a></h2>
BinaryToAscii Converter (Enter your bins here... Ej: 001110100101111001000100)
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?bin2asc">
<textarea name=data style=width:100% rows=10><?=Common::getString("bin2asc")===false?"":htmlentities(Common::getPost("data"))?></textarea>
<input type=submit value="Convert Binary to Ascii">
</form>
<?php

if(Common::getString("bin2asc")!==false){
	print "Result:<br><br>";
	print htmlentities(Encoder::bin2asc(utf8_encode(Common::getPost("data"))),ENT_QUOTES,"UTF-8");
	print "<br>";
}
?>
<br>
AsciiToBinary Converter
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?asc2bin">
<textarea name=data style=width:100% rows=10><?=Common::getString("asc2bin")===false?"":htmlentities(Common::getPost("data"))?></textarea>
<input type=submit value="Convert Ascii to Binary">
</form>

<?php

if(Common::getString("asc2bin")!==false){
	print "Result:<br><br>";
	print Encoder::asc2bin(Common::getPost("data"));
	print "<br><br>";
}
?>
<hr>
<br>
Some credits goes for the author of the php code (cut &amp; pasted) found in this page:<br>
<a href="http://www.planet-source-code.com/vb/scripts/ShowCode.asp?txtCodeId=1646&lngWId=8" target=_blank>http://www.planet-source-code.com/vb/scripts/ShowCode.asp?txtCodeId=1646&lngWId=8</a>
<?
print Website::footer();
?>	