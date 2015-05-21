<?php
class Website{
	function defaultMethod(){
		return Template::load(__CLASS__,"default.php");
	}
	function title(){return "Welcome";}
	static function footer(){return Template::load(__CLASS__,"footer.php");}
	static function header($vars=array()){
		if(!isset($vars["title"])) $vars["title"]="Untitled";
		return Template::load(__CLASS__,"header.php",$vars);
	}
}
?>