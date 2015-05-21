<?php
class Tron{
	function defaultMethod(){
		return self::races();
	}
	function title(){return "Tron";}
	function races(){
		ob_end_flush();
		return Template::load(__CLASS__,"races.php");
	}
	static function playerWins($game,$code){
		if(Session::logged()){
			if(!self::gameCodeExists($game,$code)){
				self::addGameCode($game,$code);
				Rankings::rank(Challenges::getChallId());
				return Common::Info("Felicidades, acabas de puntuar en este juego! ".Smiley::build(":D"));
			}else{
				return Common::Info("El código que has enviado ya existe en el core de Tr0n y no se puntuará la prueba.".Smiley::build(":-/"));
			}
		}else{
			return Common::Info("Logeate antes si deseas puntuar en este juego! ".Smiley::build(":-|"));
		}
	}
	static function gameCodeExists($game,$code){
		Db::connection();
		$res=Db::select("tron","1","game='".mysql_real_escape_string($game)."' AND md5='".mysql_real_escape_string(md5($code))."'");
		if(count($res)) return true;
		return false;
	}
	static function addGameCode($game,$code){
		Db::connection();
		Db::insert("tron",array("nick"=>Session::get("login"),"game"=>$game,"code"=>$code,"md5"=>md5($code)));
		return;
	}
	static function checkCode($code){
		$whitelist=array(" controller"," if",">direction",">getY","rand",">getX",">collisionDistance");
		$blacklist=array("`","include","require","\/\/","#");
		$code=preg_replace("/(\s|\r|\n|\t)/"," ",$code);
		$errors=false;
		//preg_match_all("/(.(\w|}|\/)+)[\s\t\r\n]*\(/",$code,$f);
		preg_match_all("/(.(\w|_|#|[\x7f-\xff]|}|\/|\])+)[\s\t\r\n]*\(/",$code,$f);
		for($i=0;$i<count($f[0]);$i++){
			$function=$f[1][$i];
			if(!in_array($function,$whitelist)) {
				print "<font color=red><b>mother.trn: unknown function ".htmlentities($f[0][$i],ENT_QUOTES,"iso-8859-1").")! reporting this error and aborting this match...</b></font><br>";
				$errors=true;
			}
		}
		foreach($blacklist as $b){
			if(preg_match("/($b)/i",$code,$m)){
				print "<font color=red><b>mother.trn: unknown code ".htmlentities($m[1])." ! reporting this error and aborting this match...</b></font><br>";
				$errors=true;
			}
		}
		$invalidChars=array();
		for($i=0;$i<strlen($code);$i++){
			if(ord($code[$i])>0x7e || ord($code[$i])<0x20){
				if(!in_array($code[$i],$invalidChars)) array_push($invalidChars,$code[$i]);
				$errors=true;
			}
		}
		if(count($invalidChars)){
			print "<font color=red><b>mother.trn: unknown character(s) ".htmlentities(join("",$invalidChars),ENT_QUOTES,"iso-8859-1")." found! reporting this error and aborting this match...</b></font><br>";
		}
		return $errors;
	}
}
?>
