<?php
class Common{
	static function getString($var){
		if(!isset($_GET[$var])) return false;
		return $_GET[$var];
	}
	static function getInteger($var){
		if(!isset($_GET[$var])) return false;
		return intval($_GET[$var]);
	}
	static function getPost($var){
		if(!isset($_POST[$var])) return false;
		return $_POST[$var];
	}
	static function Error($msg){
		return Template::load(__CLASS__,"error_box.php",array("msg"=>$msg));
	}
	static function Info($msg,$align="left"){
		return Template::load(__CLASS__,"info_box.php",array("msg"=>$msg,"align"=>$align));
	}
	static function getAllParams(){
		$params=Array();
		foreach($_GET as $key=>$val){
			if(preg_match("/^p/",$key)) array_push($params,$val);
		}
		return $params;
	}
	static function redir($location){
		header("Location: $location");
		die;
	}
}
?>