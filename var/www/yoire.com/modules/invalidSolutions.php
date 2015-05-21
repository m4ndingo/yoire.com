<?php
class InvalidSolutions{
	static function add($solution,$challId){
		Db::connection();
		$res=Db::select("invalidsolutions","1","solution='".mysql_real_escape_string($solution)."' AND name='".mysql_real_escape_string($challId)."' AND nick='".mysql_real_escape_string(Session::get("login"))."'");
		if(count($res)) return;
		Db::insert("invalidsolutions",array("nick"=>Session::get("login"),"name"=>$challId,"solution"=>$solution,"tip"=>Encoder::asc2bin($_SERVER['REMOTE_ADDR'])));
		return;
	}
	static function challsSolved(){
		return Db::selectAll("challssolved","*","nick='".mysql_real_escape_string(Session::get("login"))."'","name");
	}
}
?>
