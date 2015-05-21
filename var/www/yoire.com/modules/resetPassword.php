<?php
class ResetPassword{
	function defaultMethod(){
		$msg="";
		$login=Common::getPost("login");
		$token=Common::getString("token");
		if($login!==false) $msg=self::onReset($login);
		if($token!==false) return self::onTokenReceived($token);
		return Template::load(__CLASS__,"default.php",array("msg"=>$msg));
	}
	function title(){return "Reset your password";}
	static function onTokenReceived($token){
		Db::connection();
		$res=Db::select("members","1","token='".mysql_real_escape_string($token)."'");
		if(!count($res))return Common::Error("El token parece incorrecto / The token seems to be invalid ".Smiley::build(":-p"));
		$res=Db::select("members","*","token='".mysql_real_escape_string($token)."'");
		if(!count($res) || !is_array($res)) return Common::Error("Las credenciales proporcionadas son incorrectas / Invalid credentials ".Smiley::build(":-/"));
		Session::login($res);
		Members::validateEmail($res["email"]);
		Common::redir("?mo=Members&me=ChangePassword");
	}
	static function onReset($login){
		if($login=="") return;
		Db::connection();
		$profile=Db::select("members","login,email","login='".mysql_real_escape_string($login)."'");
		if(!count($profile)) return Common::Error("¿Lo has escrito bien? / It's well typed? ".Smiley::build(":-p"));
		if($profile["email"]=="") return Common::Error("No se donde enviar el correo / I don't know where to send the email ".Smiley::build(":-("));
		$token=md5(rand());
		//remove all tokens
		$res=Db::update("members",array("token"=>""));
		if($res) return Common::Error($res);
		//set temporary token
		$res=Db::update("members",array("token"=>$token),"login='".mysql_real_escape_string($login)."'");
		if($res) return Common::Error($res);
		$res=self::onSendResetLink($profile["email"],$token);
		if($res){
			return Common::Info("Comprueba tu correo electrónico... / Check your email inbox ... ".Smiley::build(":)"));
		}else{
			return Common::Error("Parece que el envio fallo / It seems that the sent failed ... ".Smiley::build(":-P"));
		}
	}
	static function onSendResetLink($email,$token){
		$link="http://".Config::$site_title."/?mo=ResetPassword&token=$token";
		$msg="<a href='$link'>$link</a>";
		return Mailer::sendFromWebmaster($email,Config::$site_title."_Reset Password Confirmation",$msg);
	}
}
?>