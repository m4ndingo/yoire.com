<?=$vars["title"]?>
<?php
print PHP_EOL;
for($i=0;$i<strlen($vars["title"]);$i++) print "=";
print PHP_EOL.PHP_EOL;
?>
<?=$vars["content"]?>
<?php
$footer="Source: yoire.com - Date: ".date("F j, Y, g:i a",$vars["date"])." - Published by: ".$vars["from_u"];
print PHP_EOL;
for($i=0;$i<strlen($footer);$i++) print "_";
print PHP_EOL;
print $footer;
?>

