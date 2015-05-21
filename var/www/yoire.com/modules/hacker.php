<?php
class Hacker{
	function defaultMethod(){
		$img=Common::getString("img");
		if($img===false){
			$images=self::getFiles("img/v/");
			srand(time());
			if(count($images)) $img=$images[rand(0,count($images)-1)];
		}
		return Template::load(__CLASS__,"default.php",array("img"=>$img));
	}
	function title(){return "Hacker!";}

	static function getFiles($dir){
		$items=array();
		if($d=opendir($dir)){
			while($f=readdir($d)){
				if(preg_match("/^\./",$f)) continue;
				array_push($items,$f);
			}
		}
		return $items;
	}
}
?>