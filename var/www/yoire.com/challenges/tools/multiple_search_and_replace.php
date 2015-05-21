<?php
include("../../core.php");
print Website::header(array("title"=>"Multiple Search &amp; Replace v0.1 - by Mandingo"));
?>
<h2>Multiple Search &amp; Replace v0.1 - by Mandingo <a href="<?=$_SERVER["PHP_SELF"]?>/.." class=underline>close [x]</a></h2>
Input data:
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?replace">
<textarea name=data style=width:100% rows=10><?=Common::getPost("data")?></textarea>
Replacements:
<textarea name=replacements style=width:100% rows=10><?=Common::getPost("replacements")?></textarea>
<input type=submit value="Replace">
</form>
<?php

if(Common::getString("replace")!==false){
	$replacements=Common::getPost("replacements");
	$from=array();
	$to=array();
	foreach(preg_split("/\n|\r/",$replacements) as $line){
		if(preg_match("/(.*)->(.*)/",$line,$m)){
			array_push($from,$m[1]);
			array_push($to,$m[2]);
		}
	}
	print "Result:<br><br>";
	print htmlentities(utf8_encode(Encoder::transform(Common::getPost("data"),$from,$to)),ENT_QUOTES,"UTF-8");
	print "<br>";
}
?>
<hr>
<pre>
<b>Usage Example</b>

Data:
This is not cool

Replacements:
i-&gt;1
not-&gt;really
o-&gt;0

Result:
Th1s 1s really c00l
<?
print Website::footer();
?>