<?php

class Rules{
	static function getRules(){
		$rules=array();
		foreach(self::XMLfiles() as $xmlfile){
			$rule=Array();
			$rule["file"]=$xmlfile;
			list($rule["description"],$rule["search"])=self::parseXML($xmlfile);
			array_push($rules,$rule);
		}
		return $rules;
	}
	function parseXML($xmlfile){
		if(!file_exists($xmlfile)) return array();
		$items=array();
		$description="None";
		$in=fopen($xmlfile,"r");
		while(!feof($in)){
			$line=fgets($in);
			if(preg_match("/<description>(.+)?<\/description>/",$line,$m)) $description=$m[1];
			if(preg_match("/<search>/",$line)){
				while(!feof($in) && !preg_match("/<\/search>/",$line)){
					if(preg_match("/<item[^>]*>(.+)?<\/item>/",$line,$m)){
						array_push($items,$m[1]);
					}
					$line=fgets($in);
				}
			}
		}
		return Array($description,$items);
	}
	function XMLfiles(){
		$files=array();
		if ($handle = opendir('rules')) {
			while (false !== ($entry = readdir($handle))) {
				if(!preg_match("/\.xml$/",$entry)) continue;
				array_push($files,"rules/".$entry);
    			}
    		closedir($handle);
		}
		return $files;
	}
}
