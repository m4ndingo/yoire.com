<?php
include("../../../core.php");
print Website::header(array("title"=>"ASCII Table"));
print "<table align=center><tr>";
for($j=0;$j<=255;$j+=32){
	print "<td>";
	?>
	<table class=inboxTable align=center>
	<tr><td class=header>Decimal</td><td class=header>Hexa</td><td class=header>Ascii</td></tr>
	<?php
	for($i=$j;$i<=$j+32;$i++){?>
	<tr>
		<td align=center><b><?=$i?></b></td>
		<td align=center><?=sprintf("%2x",$i)?></td>
		<td align=center><?=htmlentities(sprintf("%c",$i),ENT_QUOTES,"utf-8")?></td>
	</tr>
	<?php
	}
	?>
	</table>
	<?php
	print "</td>";
}
print "</tr></table>";
print Website::footer();
?>
