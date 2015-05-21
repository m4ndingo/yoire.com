<?php
class ProbeHacker{
	function defaultMethod(){
		return Template::load(__CLASS__,"default.php");
	}
	function title(){return "Probe you are a hacker";}
}
?>