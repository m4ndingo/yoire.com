<?php
class Session{
	static function login($data){
		$_SESSION["data"]=$data;
		$_SESSION["logged"]=true;
	}
	static function logged(){
		Online::ping();
		if(!isset($_SESSION) || !isset($_SESSION["logged"]) || !$_SESSION["logged"] || !isset($_SESSION["data"])) {
			self::logout();
			return false;
		}
		self::updateLastActivity();
		return true;
	}
	static function get($var){
		if(!isset($_SESSION["data"])) return;
		if(!isset($_SESSION["data"][$var])) return;
		return $_SESSION["data"][$var];
	}
	static function logout(){
		if(isset($_SESSION["data"]))	unset($_SESSION["data"]);
		if(isset($_SESSION["logged"]))	unset($_SESSION["logged"]);
	}
	static function updateLastActivity(){
		Db::connection();
		Db::update("members",array("lastActivity"=>time()),"login='".mysql_real_escape_string(self::get("login"))."'");
	}
	static function refresh(){
		$msg="";
		Db::connection();
		$res=Db::select("members","*","login='".mysql_real_escape_string(Session::get("login"))."'");
		if(!$res) $msg.=Common::Error("Error inesperado... >8-p ");
		Session::login($res);
	}
}
?>