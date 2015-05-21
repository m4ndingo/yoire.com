<?php
class Template{
	static function load($classname,$filename,$vars=array()){
		$template="templates/".basename($classname)."/".basename($filename);
		if(!file_exists($template)) return "<font color=#d00><b>No se encontro la plantilla '".$template."'</b></font>";
		ob_start();
		include($template);
		$data=ob_get_contents();
		ob_clean();
		return $data;
	}
}
?>