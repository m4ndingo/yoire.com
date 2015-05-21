<?php
class Pm{
	private static $limit=15;
	function defaultMethod(){
		if(!Session::logged()) Common::redir(Config::$base."?mo=Members");
		$to = Common::getString("to");
		$page = Common::getString("page")+0;
		$maxpages = self::total()/self::$limit-1;
		if($to!==false && !Members::exists($to)) Common::redir(Config::$base."?mo=Members&me=ViewProfile&id=".urlencode($to));
		Members::newPm(Session::get("login"),0);
		Session::refresh();
		$members=Members::getAll();
		return Template::load(__CLASS__,"default.php",array("members"=>$members,"to"=>$to,"msg"=>"","inbox"=>self::inbox($page),"page"=>$page,"maxpages"=>$maxpages));
	}
	function title(){return "PM";}
	function send(){
		$msg=Common::getPost("msg");
		$to=urldecode(Common::getPost("nick"));
		if(!strlen($msg)) return self::defaultMethod();
		$login=Session::get("login")?Session::get("login"):"Anonymous";
		self::add($to,$msg,$login);		
		$page = Common::getString("page")+0;
		$maxpages = self::total()/self::$limit-1;
		$members=Members::getAll();
		return Template::load(__CLASS__,"default.php",array("members"=>$members,"msg"=>Javascript::alert("(: Mensaje a enviado a / Message sent to --> $to"),"to"=>$to,"inbox"=>self::inbox(),"page"=>$page,"maxpages"=>$maxpages));
	}
	static function add($to,$msg,$from){
		Db::connection();
		Db::insert("pm",array("to_m"=>$to,"msg"=>$msg,"from_u"=>$from));
		Members::newPm($to);
	}
	function total(){
		Db::connection();
		$res=Db::select("pm","count(id) as c","to_m='".mysql_real_escape_string(Session::get("login"))."'");
		return $res["c"];
	}
	function inbox($page=0){
		Db::connection();
		return Db::selectAll("pm","id,from_u,msg,date","to_m='".mysql_real_escape_string(Session::get("login"))."'","date DESC",$page*self::$limit.",".self::$limit);
	}
	static function quote($msg){
		$msg=preg_replace("/{quote}/","<span class=quote>",$msg);
		$msg=preg_replace("/{.quote}/","</span>",$msg);
		return $msg;
	}
}
?>