<?php
class Core{
	private $classes_dir="modules";
	private $page="Empty page...";
	private $pageTitle="Untitled page...";
	private $classes;
	public $modules;
	private $mo="";
	private $me;
	private $params=Array();
	function Core(){
		$this->disableMagicQuotes();
		$this->findMyself();
		$this->loadClasses();
		if(!Db::checkDb()) return $this->setError(Db::$lastError);
		$this->loadDbClasses();
		$this->mo=Common::getString("mo");
		$this->me=Common::getString("me");
		$this->params=Common::getAllParams();
		$this->executeModule();
	}
	function findMyself(){
		$iters=0;
		$curdir=getcwd();
		while(!file_exists($curdir."/core.php") && $iters++<5){
			$curdir=preg_replace("/(.*)((\\\\|\/).*)/","$1",$curdir);
		}
		chdir($curdir);
	}
	function executeModule(){
		if(!strlen($this->mo)) $this->mo="ProbeHacker";// antes "Website"
		$this->mo=preg_replace("/!/","",$this->mo);
		if(!isset($this->modules[$this->mo])) return $this->setError("Módulo <b>".htmlentities(utf8_encode($this->mo),ENT_QUOTES,"UTF-8")."</b> no encontrado...");
		$module=$this->modules[$this->mo];
		if(!strlen($this->me)) $this->me="defaultMethod";
		if(!method_exists($module,$this->me)) return $this->setError("El método <b>".htmlentities($this->me,ENT_QUOTES,"UTF-8")."</b> no está implementado...");
		$classMethod = new ReflectionMethod($module,$this->me);
		$argumentCount = count($classMethod->getParameters());
		if($argumentCount>count($this->params)) return $this->setError("Número de parámetros incorrecto...");

		$this->page=call_user_func_array(array($module,$this->me),$this->params);
		if(method_exists($module,"title")) $this->pageTitle=call_user_func_array(array($module,"title"),array());
	}
	function loadDbClasses(){
		$f="prueba";
		$f=ucfirst($f);
		$class=ClassBuilder::loadClass($f);
		array_push($this->classes,$f);
		$this->modules[$f]=$class;
	}
	function loadClasses(){
		if($d=opendir($this->classes_dir)){
			while($f=readdir($d)){
				if(preg_match("/^\./",$f)) continue;
				$this->loadClass($this->classes_dir."/".$f);
				if(!is_array($this->classes)) $this->classes=Array();
				if(!is_array($this->modules)) $this->modules=Array();
				$f=preg_replace("/\.php$/","",$f);
				$f=ucfirst($f);
				$f=preg_replace("/!/","",$f);
				array_push($this->classes,$f);
				$this->modules[$f]=new $f();
			}
		}
	}
	function loadClass($path){include($path);}
	function setError($msg){
		$this->page=Common::Error($msg);
	}
	function page(){
		$page=Website::header(array("title"=>Config::$site_title."_".$this->pageTitle));
		$page.=$this->page;
		$page.=Website::footer();
		return $page;
	}
	function disableMagicQuotes(){
		if (get_magic_quotes_gpc()) {
			function stripslashes_gpc(&$value)
			{
				$value = stripslashes($value);
			}
			array_walk_recursive($_GET, 'stripslashes_gpc');
			array_walk_recursive($_POST, 'stripslashes_gpc');
			array_walk_recursive($_COOKIE, 'stripslashes_gpc');
			array_walk_recursive($_REQUEST, 'stripslashes_gpc');
		}
	}
}
$core=new Core();
?>