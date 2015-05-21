<?php
class ClassBuilder{
	function defaultMethod(){
		return Template::load(__CLASS__,"default.php");
	}
	function title(){return "Class Builder";}
	function save(){
		if(!strlen(Common::getPost("name"))) return Common::Error("No se indico un nombre para la clase");
		if(!strlen(Common::getPost("data"))) return Common::Error("El codigo de la clase esta vacio");
		$res=Db::insert("classes",array("name"=>Common::getPost("name"),"data"=>Common::getPost("data")));
		if(!strlen($res)) return "Clase guardada";
		return Common::Error($res);
	}
	static function loadClass($name){
		Db::connection();
		$res=Db::select("classes","	*","name='".mysql_real_escape_string($name)."'");	//real_escape requiere conexion a db
		if(strlen(Db::$lastError)) return Common::Error(Db::$lastError);
		if(!count($res)) return;
		return;
		$code="<?php\n";
		$code.="class $name{\n";
		$code.=$res["data"]."\n";
		$code.="}\n";
		$code.="?>\n";
		
		$tmpfile = tempnam(sys_get_temp_dir(),"CLASS");
		file_put_contents($tmpfile,$code);
		include($tmpfile);
		$class=new $name();
		unlink($tmpfile);

		return $class;
	}
}
?>