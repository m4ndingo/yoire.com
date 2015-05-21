<?php
class Online{
	function defaultMethod(){
		//self::ping();
		$users=self::getActive(60*24);
		return Template::load(__CLASS__,"default.php",array("activeUsers"=>$users));
	}
	function title(){return "Users online";}
	static function ping(){
		$res=Db::select("online","*","nick='".mysql_real_escape_string(Session::get("login"))."'");
		if(!$res){
			Db::insert("online",array("nick"=>Session::get("login"),"module"=>Common::getString("mo"),"script"=>$_SERVER["SCRIPT_NAME"],"time"=>time()));
		}else{
			if(Common::getString("mo")=="Online" || Common::getString("mo")=="Members"){
				Db::update("online",array("script"=>$_SERVER["SCRIPT_NAME"],"time"=>time()),"nick='".mysql_real_escape_string(Session::get("login"))."'");
			}else{
				$mo=Common::getString("mo");
				$mo=preg_replace("/<.*/","",$mo);
				$mo=htmlentities($mo);
				Db::update("online",array("module"=>$mo,"script"=>$_SERVER["SCRIPT_NAME"],"time"=>time()),"nick='".mysql_real_escape_string(Session::get("login"))."'");
			}
		}
	}
	static function getActive($minutes=1){
		$res=Db::selectAll("online","*","time>".(time()-(60*$minutes)));
		if(!is_array($res)) return;
		return $res;
	}
}
?>