<?php
class Rankings{
	static function rank($challname){
		Db::connection();
		$res=Db::select("challssolved","1","name='".mysql_real_escape_string($challname)."' AND nick='".mysql_real_escape_string(Session::get("login"))."'");
		if(count($res)) return Common::Info("Pero... ya resolviste este reto, asi que no puntua... / But you already solved this challenge, so it doesn't scores ".Smiley::build("^_^"),"center");
		$res=Db::insert("challssolved",array("nick"=>Session::get("login"),"name"=>$challname));
		if($res) return Common::Error($res);
		return Common::Info("Tu progreso ha sido guardado para la posteridad / Your progress has been saved for posterity ".Smiley::build(";)"),"center");
	}
	static function challsSolvedBy($id=""){
		if($id=="") return self::solvedByCurrentMember();
		return self::solvedByMember($id);
	}
	static function solvedByMember($id){
		return Db::selectAll("challssolved","*","nick='".mysql_real_escape_string($id)."'","name");
	}
	static function solvedByCurrentMember(){
		return Db::selectAll("challssolved","*","nick='".mysql_real_escape_string(Session::get("login"))."'","name");
	}
	static function level($id=""){
		if($id=="") return self::currentMemberLevel();
		if(!Members::exists($id)) return "???";
		$level=9;
		if(Members::emailValidated($id)){
			$level--;
			$pSolved=Challenges::percentageSolved($id);
			if($pSolved>=25) $level--;
			if($pSolved>=50) $level--;
			if($pSolved>=75) $level--;
			if($pSolved==100) $level--;
		}
		return $level;
	}
	static function currentMemberLevel(){
		$level=10 - (Session::logged()?1:0);
		$level-=    (Session::get("emailValidated")?1:0);
		if(Session::get("emailValidated")){
			if(Challenges::percentageSolved()>=25) $level--;
			if(Challenges::percentageSolved()>=50) $level--;
			if(Challenges::percentageSolved()>=75) $level--;
			if(Challenges::percentageSolved()==100) $level--;
		}
		return $level;
	}
	static function challsUnsolved(){
		$unsolved=array();
		$solved=self::solvedByCurrentMember();
		$all=Challenges::retrieveChallenges();
		foreach($all as $chall){
			$chall=preg_replace("/challenges\//","",$chall);
			$found=false;
			foreach($solved as $s){
				if($s["name"]==$chall) {$found=true;break;}
			}
			if(!$found) array_push($unsolved,$chall);
		}
		return $unsolved;
	}
	static function challSolved($challId){
		return count(Db::select("challssolved","id","name='".mysql_real_escape_string($challId)."' AND nick='".mysql_real_escape_string(Session::get("login"))."'"));
	}
}
?>