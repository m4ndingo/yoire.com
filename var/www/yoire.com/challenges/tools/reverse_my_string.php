<?php
include("../../core.php");
print Website::header(array("title"=>"Reverse my String v0.1 - by Mandingo"));
?>
<h2>Multiple Search &amp; Replace v0.1 - by Mandingo <a href="<?=$_SERVER["PHP_SELF"]?>/.." class=underline>close [x]</a></h2>
Your string:
<form method=POST action="<?=$_SERVER["PHP_SELF"]?>?reverse">
<textarea name=data style=width:100% rows=10><?=Common::getPost("data")?></textarea>
<input type=submit value="Reverse">
</form>
<?php
if(Common::getString("reverse")!==false){
	print "Result:<br><br>";
	print htmlentities(strrev(Common::getPost("data")),ENT_QUOTES,"UTF-8");
	print "<br>";
}
print Website::footer();
?>