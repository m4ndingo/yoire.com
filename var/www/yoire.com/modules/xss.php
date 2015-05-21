<?php
class Xss{
	static function filter($data){
		$data=preg_replace("/(<|>|'|\")/",htmlentities("$1",ENT_IGNORE,"UTF-8"),$data);
		$data=preg_replace("/\n/","<br>",$data);
		return $data;
	}
}
?>