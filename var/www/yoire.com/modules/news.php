<?php
class News{
	private static $limit=15;
	private static $defaultMsg="";
	function defaultMethod(){
		$page = Common::getString("page")+0;
		$section=Common::getString("section");
		if($section=="*") $section="";
		$maxpages = self::total($section)/self::$limit-1;
		$news=self::getNews($page,$section);
		$sections=self::getSections();
		$msg=self::$defaultMsg;
		return Template::load(__CLASS__,"default.php",array("news"=>$news,"sections"=>$sections,"section"=>$section,"msg"=>$msg,"page"=>$page,"maxpages"=>$maxpages));
	}
	function title(){return "News";}
	function publishComment(){
		if(strlen(Common::getPost("message"))){
			$login=Session::get("login")?Session::get("login"):"Anonymous";
			$msg=self::addComment(Common::getPost("message"),Common::getInteger("id"),$login);
			if($msg=="") self::$defaultMsg=Javascript::alert("Comentario publicado / Comment published :)");
		}
		return self::defaultMethod();
	}
	function comment(){
		$data=self::getNewById(0+Common::getInteger("id"));
		if(empty($data)) return Common::Error("Article not found.. ".Smiley::build(":-p"));
		$data["comments"]=self::getComments(Common::getInteger("id"));
		return Template::load(__CLASS__,"comment.php",$data);
	}
	function raw(){
		$data=self::getNewById(Common::getInteger("id"));
		header("Content-Type: text/plain");
		if(empty($data)) die("Article not found.. :-p");
		print Template::load(__CLASS__,"raw.php",$data);
		die();
	}
	function publish(){
		$title=Common::getPost("title");
		if(!strlen($title)) return self::defaultMethod();
		$section=Common::getPost("section");
		if(!strlen($section)) $section="unknown";
		$content=Common::getPost("content");
		$source=Common::getPost("source");
		if($content=="" && $source=="http://") return self::defaultMethod();
		$login=Session::get("login")?Session::get("login"):"Anonymous";

		$msg=Javascript::alert("(: Contenido publicado / Content published");

		$res=self::add($section,$title,$content,$source,$login);
		if(strlen($res)) $msg=$res;

		$page = Common::getString("page")+0;
		$maxpages = self::total($section)/self::$limit-1;
		$news=self::getNews($page);
		$sections=self::getSections();

		return Template::load(__CLASS__,"default.php",array("news"=>$news,"sections"=>$sections,"section"=>$section,"msg"=>$msg,"page"=>$page,"maxpages"=>$maxpages));
	}
	static function addComment($message,$id,$from_u){
		Db::connection();
		$res=Db::insert("newscomments",array("message"=>$message,"idNews"=>$id,"from_u"=>$from_u,"date"=>time()));
		if(strlen($res)) return Common::Error($res);
		return;
		
	}
	static function add($section,$title,$content,$source,$from){
		Db::connection();
		$res=Db::insert("news",array("source"=>$source,"content"=>$content,"title"=>$title,"section"=>$section,"from_u"=>$from,"date"=>time()));
		if(strlen($res)) return Common::Error($res);
		return;
		
	}
	function total($section){
		Db::connection();
		$where=$section!=""?"section like '%".mysql_real_escape_string($section)."%'":"";
		$res=Db::select("news","count(id) as c",$where);
		if(!is_array($res)) return 0;
		return $res["c"];
	}
	function getComments($idNews){
		Db::connection();
		$res=Db::selectAll("newscomments","id,idNews,message,from_u,date","idNews=$idNews","date DESC");
		return $res;
	}
	function getNews($page=0,$section=""){
		Db::connection();
		$where=$section!=""?"section like '%".mysql_real_escape_string($section)."%'":"";
		$res=Db::selectAll("news","id,from_u,content,title,source,date",$where,"date DESC",$page*self::$limit.",".self::$limit);
		$news=array();
		foreach($res as $r){
			$r["comments"]=self::getComments($r["id"]);
			array_push($news,$r);
		}
		return $news;
	}
	function getNewById($id){
		Db::connection();
		$where="id=$id";
		return Db::select("news","*",$where);
	}
	function getSections(){
		Db::connection();
		//return Array("security","misc");
		$res=Db::selectAll("news","section");
		$sections=array("*");
		if(!count($res) || $res===false) return $sections;
		foreach($res as $r){
			$name=$r["section"];
			if(!preg_match("/^[a-z0-9\s,&\!]+$/",$name)) continue;
			foreach(preg_split("/[\s,&]/",$name) as $sname){
				if(!strlen($sname)) continue;
				if(!in_array($sname,$sections)) array_push($sections,$sname);
			}
		}
		return $sections;
	}
}
?>