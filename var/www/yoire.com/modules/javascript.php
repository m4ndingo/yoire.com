<?php
class Javascript{
	static function focus($form,$field){
		return "<script>document.$form.$field.focus()</script>\n";
	}
	static function alert($msg){
		return "<script>alert('".preg_replace("/'/","\'",$msg)."')</script>\n";
	}
}
?>