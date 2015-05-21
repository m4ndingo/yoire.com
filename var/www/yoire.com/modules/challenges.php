<?php
class Challenges{
	function defaultMethod(){
		return Template::load(__CLASS__,"default.php");
	}
	function title(){return "Challenges";}
	static function solutionBox(){
		$html= "<form method=POST name=frmSolution>".PHP_EOL;
		$html.="Solución / Solution : <input type=text size=16 name=solution>".PHP_EOL;
		$html.="<input type=submit value='Enviar / Send'>".PHP_EOL;
		$html.="</form>".PHP_EOL;
		$html.=Javascript::focus("frmSolution","solution");
		return $html;
	}
	static function dificulty($id=""){
		if($id=="")	$id=self::getChallId();
		Db::connection();
		$res=Db::select("challssolved","count(*) as c","name='".mysql_real_escape_string($id)."'");
		if($res!==false && count($res)) $solved_times=$res["c"];
			else $solved_times=0;
		$res=@Db::select("invalidsolutions","count(*) as c","name='".mysql_real_escape_string($id)."'");
		if($res!==false && count($res)) $failed_times=$res["c"];
			else $failed_times=0;
		//print "failed ".$failed_times."/"."solved ".$solved_times."<br>";
		if($solved_times==0) return "Desconocido / Unknown (no resuelto aún / not solved yed)";
		$calc=$failed_times/($solved_times+$failed_times);
		if($calc>=0.80) return "Muy difícil / Very Hard";
		if($calc>=0.60) return "Difícil / Hard";
		if($calc>0.40)  return "Intermedio / Average";
		if($calc>0.20)  return "Fácil / Easy";
		if($calc<=0.20) return "Muy fácil / Very Easy";
		return $calc;
	}
	static function getChallId(){
		$id=$_SERVER["SCRIPT_NAME"];
		$id=preg_replace("/^.*challenges\//","",$id);
		return $id;
	}
	static function solved(){
		$challId=self::getChallId();
		return Rankings::challSolved($challId);
	}
	static function checkSolution($realSolution){
		$solution=Common::getPost("solution");
		if($solution=="") return;
		$id=self::getChallId();
		if($solution==$realSolution) {
			$okMsg="La solución es correcta / The solution is correct ".Smiley::build(":-D")." ";
			if(!Session::logged()) $okMsg.="<a href=?mo=Members target=_top>Logeate</a>";
				else {
					$okMsg.="<a href=?mo=Website target=_top>Inicio</a> | <a href=?mo=Contact target=_top>Contacto</a> | <a href=?mo=Members target=_top>Tu perfil</a> | <a href=?mo=Challenges target=_top>Challenges</a> (<a href='".Config::$base."' target=_top>Random Probe</a>)";
					$okMsg.=Rankings::rank($id);
				}
			return Common::Info($okMsg,"center");
		}
		self::onInvalidSolution($id);
		return Common::Info("La solución es incorrecta / The solution is incorrect ".Smiley::build(":-("));
	}
	static function onInvalidSolution($challId){
		$solution=Common::getPost("solution");
		InvalidSolutions::add($solution,$challId);
	}
	static function header(){
		return Template::load(__CLASS__,"header.php",array("file"=>basename($_SERVER["PHP_SELF"]),"dir"=>dirname($_SERVER["PHP_SELF"])));
	}
	static function retrieveChallenges(){
		$challs=array();
		$files=self::getFiles("challenges");
		$html="";
		foreach($files as $f){
			if($f["isDir"]) continue;
			if(preg_match("/tools|support_files/",$f["path"])) continue;
			$f["path"]=preg_replace("/challenges\//","",$f["path"]);
			array_push($challs,$f["path"]);
		}
		return $challs;
	}
	static function percentageSolved($id=""){
		return sprintf("%.2f",count(Rankings::challsSolvedBy($id))/count(self::retrieveChallenges())*100);
	}
	static function getRandom(){
		if(Session::logged()){
			$challs=Rankings::challsUnsolved();
		}else{
			$challs=self::retrieveChallenges();
		}
		if(!count($challs)) Common::redir(Config::$base."?mo=Hacker!");
		$randItem=rand(0,count($challs)-1);
		$link="challenges/".$challs[$randItem];
		return "<iframe src='$link' width=100% height=80% frameborder=0 scrolling=auto></iframe>";
	}
	static function getFiles($dir){
		$items=array();
		if($d=opendir($dir)){
			while($f=readdir($d)){
				if(preg_match("/^\./",$f)) continue;
				$path=$dir."/".$f;
				$item=array();
				$item["path"]=$path;
				$item["isDir"]=is_dir($path)?1:0;
				array_push($items,$item);
				if($item["isDir"]){
					$items=array_merge($items,self::getFiles($item["path"]));
				}
			}
		}
		return $items;
	}
}
?>