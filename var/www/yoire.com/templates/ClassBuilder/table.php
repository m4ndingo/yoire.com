<?php
if(isset($vars["rows"])){
	$rows=$vars["rows"];
	?>
	<table border=1>
	<?php
	//Encabezado
	$keys=array_keys($rows[0]);
	print "<tr>";
	foreach($keys as $k){
		print "<td>$k</td>";
	}
	print "</tr>".PHP_EOL;
	//Filas
	for($i=0;$i<count($rows);$i++){
		print "<tr valign=top>";
		foreach($rows[$i] as $v){
			$html=Xss::filter($v);
			print "<td>".$html."</td>";
		}
		print "</tr>".PHP_EOL;
	}
	?>
	</table>
<?php
}else{
		print Common::Error("La variable \$rows no está inicializada...");
}?>