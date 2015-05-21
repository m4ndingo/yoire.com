<?php
class Members{
	function defaultMethod(){
		$msg="";
		if(Common::getPost("action")=="register")	$msg=self::onRegister();
		if(Common::getPost("action")=="login")		$msg=self::onLogin();
		if(!Session::logged()){
			return Template::load(__CLASS__,"default.php",array("msg"=>$msg));
		}else{
			Session::refresh();
			$solved=Rankings::challsSolvedBy();
			$pSolved=Challenges::percentageSolved();
			return Template::load(__CLASS__,"profile.php",array("msg"=>$msg,"solved"=>$solved,"pSolved"=>$pSolved));
		}
	}
	function title(){return "Members";}
	static function count(){
		Db::connection();
		$res=Db::select("members","count(*) as c");
		if($res!==false) return $res["c"];
		return 0;
	}
	static function getAll(){
			Db::connection();
			return Db::selectAll("members","login");
	}
	static function newPm($nick,$value=1){
			Db::update("members",array("newPMs"=>$value),"login='".mysql_real_escape_string($nick)."'");
	}
	function unsolved(){
			$unsolved=Rankings::challsUnsolved();
			return Template::load(__CLASS__,"unsolved_challenges.php",array("unsolved"=>$unsolved));
	}
	function levelsPage(){
			return Template::load(__CLASS__,"levels_page.php");
	}
	function validateEmail($email){
			Db::connection();
			Db::update("members",array("emailValidated"=>1),"email='".mysql_real_escape_string($email)."'");
			Session::refresh();
	}
	function verifyEmail(){
			$msg="";
			$token=Common::getString("token");
			if($token!==false){
				$msg="Comprobando el token... ";
				Db::connection();
				$res=Db::select("members","1","token='".mysql_real_escape_string($token)."' AND email='".Session::get("email")."'");
				if(count($res)) {
					$msg.="ok, es correcto :-)";
					$res=Db::update("members",array("emailValidated"=>1),"login='".mysql_real_escape_string(Session::get("login"))."'");
					if($res) $msg.=" Wops.. fallo la base de datos! :-O";
						else $msg.=" Tu correo ha sido validado ".Smiley::build(";)");
						//remove all tokens
						$res=Db::update("members",array("token"=>""));
				}else{
					$msg.="ummm, no parece que sea el bueno ¿qué intentas? :-/";
				}
				//update session
				Session::refresh();

				return Template::load(__CLASS__,"verify_email.php",array("msg"=>Common::Info($msg),"email"=>Session::get("email"),"emailValidated"=>Session::get("emailValidated")));
			}
			$email=Common::getPost("email");
			if($email!==false) $msg=self::onNewEmail($email);

			//update session
			Session::refresh();

			return Template::load(__CLASS__,"verify_email.php",array("msg"=>$msg,"email"=>Session::get("email"),"emailValidated"=>Session::get("emailValidated")));
	}
	static function exists($id){
			Db::connection();
			$res=Db::select("members","login,lastActivity","login='".mysql_real_escape_string($id)."'");
			return count($res);
	}
	static function emailValidated($id){
			Db::connection();
			$res=Db::select("members","emailValidated","login='".mysql_real_escape_string($id)."'");
			if(!count($res)) return false;
			return $res["emailValidated"]==1;
	}
	function viewProfile(){
			$id=Common::getString("id");
			Db::connection();
			$res=Db::select("members","login,lastActivity","login='".mysql_real_escape_string($id)."'");
			if(!count($res)) return Template::load(__CLASS__,"unknown_profile.php",array());
			$last=$res["lastActivity"];
			$solved=Rankings::challsSolvedBy($id);
			$memberLevel=Rankings::level($id);
			$pSolved=Challenges::percentageSolved($id);
			if(strlen($id)>16) $id=substr($id,0,13)."...";
			return Template::load(__CLASS__,"public_member_profile.php",array("solved"=>$solved,"lastActivity"=>$last,"level"=>$memberLevel,"pSolved"=>$pSolved,"id"=>$id));
	}
	function onNewEmail($email){
		if(!Session::logged()){
			return Common::Error("No estás logeado! / You are not logged! ".Smiley::build("%-("));
		}
		$token=md5(rand());
		Db::connection();
		//remove all tokens
		$res=Db::update("members",array("token"=>""));
		//check if the email exists, if not update it
		$res=Db::select("members","email","email='".mysql_real_escape_string($email)."'");
		if(!count($res)){
			//update email
			$res=Db::update("members",array("email"=>$email),"login='".mysql_real_escape_string(Session::get("login"))."'");
			if($res) return Common::Error("Error inesperado... :-p ");
		}
		//update token
		$res=Db::update("members",array("token"=>$token),"login='".mysql_real_escape_string(Session::get("login"))."'");
		if($res) return Common::Error("Error inesperado... 8-p ");
		//update session
		$res=Db::select("members","*","login='".mysql_real_escape_string(Session::get("login"))."'");
		if(!$res) return Common::Error("Error inesperado... >8-p ");
		Session::login($res);
		//mark email as "not validated"
		$res=Db::update("members",array("emailValidated"=>0),"login='".mysql_real_escape_string(Session::get("login"))."'");
		//send verification link
		$res=self::sendVerifyEmailLink($email,$token);
		return Common::Info("Email actualizado / Email updated<br>".$res);
		
	}
	static function sendVerifyEmailLink($email,$token){
		$link="http://".Config::$site_title."/?mo=Members&me=verifyEmail&token=$token";
		$msg="<a href='$link'>$link</a>";
		if(Mailer::sendFromWebmaster($email,Config::$site_title."_Email Verification",$msg))
			return "Comprueba tu correo electrónico / Check your email inbox ".Smiley::build(":)");
		return "Pero.. algo fallo al intentar enviarte un correo... ".Smiley::build(":-p");
	}
	function changePassword(){
		if(!Session::logged()){
			return Common::Error("No estás logeado! / You are not logged! ".Smiley::build("%-("));
		}else{
			$msg="";
			$password=Common::getPost("password");
			$password_confirm=Common::getPost("password_confirm");
			if($password!=$password_confirm) $msg=Common::Error("Las contraseñas no coinciden! / Passwords doesn't match ".Smiley::build(":-O"));
			if(!strlen($msg) && $password!==false) $msg=self::onNewPassword($password);
			return Template::load(__CLASS__,"changePassword.php",array("msg"=>$msg));
		}
	}
	function onNewPassword($password){
		$res=Db::update("members",array("password"=>md5(Config::$salt.$password)),"login='".mysql_real_escape_string(Session::get("login"))."'");
		if(!$res) return Common::Info("Contraseña actualizada / Password updated ".Smiley::build(";-)"));
		return Common::Error("Se produjo un error al actualizar la contraseña / An error happened when updating the password ".Smiley::build("%-P"));
	}
	function logout(){
		Session::logout();
		return Template::load(__CLASS__,"default.php",array("msg"=>Common::Info("Sesión cerrada / Session clossed ".Smiley::build(":-X"))));
	}
	static function onRegister(){
		if(Common::getPost("password")!=Common::getPost("password_confirm")) return Common::Error("Las contraseñas no coinciden! / Passwords doesn't match ".Smiley::build(":-O"));
		if(Common::getPost("password")=="") return Common::Error("¿Se te olvidó algo? / Did you forget something? ".Smiley::build(";-)"));
		Db::connection();
		$res=Db::select("members","login","login='".mysql_real_escape_string(Common::getPost("login"))."'");
		if(count($res)) return Common::Error("Ya existe un usuario registrado con ese login / The login / nickname you provided is use ".Smiley::build(":-p"));
		$res=Db::insert("members",array("login"=>Common::getPost("login"),"password"=>md5(Config::$salt.Common::getPost("password")),"email"=>Common::getPost("email")));
		if($res) return Common::Error($res);
		Pm::add(Common::getPost("login"),"Bienvenido a yoire.com!".PHP_EOL."Welcome to yoire.com!".PHP_EOL.":-D","'");
		return Common::Info("Tu cuenta ha sido registrada / Your account has been registered. Bienvenido a / Welcome to -&gt; ".Config::$site_title." <br>Ahora, identificate! / Now, login! ".Smiley::build(":-D"));
	}
	static function onLogin(){
		if(Common::getPost("login")=="") return Common::Error("¿Se te olvidó algo? / Did you forget something? ".Smiley::build(";-)"));
		Db::connection();
		$res=Db::select("members","*","login='".mysql_real_escape_string(Common::getPost("login"))."' AND password='".mysql_real_escape_string(md5(Config::$salt.Common::getPost("password")))."'");
		if(!count($res) || !is_array($res)) return Common::Error("Las credenciales proporcionadas son incorrectas / Invalid credentials ".Smiley::build(":-/"));
		Session::login($res);
		return Common::Info("ok! ya estas identificado / you are identified now ".Smiley::build("8=)"));
	}
}
?>