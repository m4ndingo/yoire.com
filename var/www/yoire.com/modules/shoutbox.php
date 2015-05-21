<?php
class Shoutbox{
	function defaultMethod(){
//		die(Common::getPost("bg"));
		$resp="";
		$message=substr(Common::getPost("message"),0,128);
		$bg=preg_replace("/[^0-9a-f]/i","",substr(Common::getPost("bg"),0,6));
		$fg=preg_replace("/[^0-9a-f]/i","",substr(Common::getPost("fg"),0,6));
		if($message!==false) $resp=self::onMessage($message,$bg,$fg);
		$messages=Shoutbox::messages();
		return Template::load(__CLASS__,"default.php",array("resp"=>$resp,"messages"=>$messages));
	}
	function title(){return "Shoutbox";}
	static function onMessage($message,$bg,$fg){
		Db::connection();
		$res=Db::select("shoutbox","*","","date DESC","1");
		if(count($res)){
			if($res["message"]==$message) return Common::Info("Don't repeat! / No te repitas! ".Smiley::build(":-p"),"center");
			$res=Db::insert("shoutbox",array("nick"=>Session::get("login"),"message"=>$message,"bg"=>$bg,"fg"=>$fg));
			if($res) return Common::Error($res);
		}
		return Common::Info("Mensaje enviado / Message sent ".Smiley::build("8-{D"),"center");
	}
	static function messages(){
		return Db::selectAll("shoutbox","*","","date DESC","100");
	}
}
?>