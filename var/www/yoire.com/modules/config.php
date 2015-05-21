<?php
//ini_set('display_errors', 1);
error_reporting(0xffffffff);

define("LOCAL_HOSTNAME","127.0.0.1");
define("CURRENT_HOSTNAME", $_SERVER["SERVER_ADDR"]);
@session_start();

class Config{
	public static $mysql_host;
	public static $mysql_database;
	public static $mysql_user;
	public static $mysql_password;
	public static $site_title="yoire.com";
	public static $install_dir=".";
	public static $base="http://localhost/bgame/";
	public static $challsHiddenDataPath="data/hiddenChallData.1337/";
	public static $challsHiddenData;
	public static $webmaster_email="mipropaganda@gmail.com";
	public static $salt="!!!_m_q(0_ó)p_m_!!!";
	public static function Init(){
		if(CURRENT_HOSTNAME==LOCAL_HOSTNAME/*|| CURRENT_HOSTNAME=="192.168.1.128"*/){
			self::$mysql_host = "localhost";
			self::$mysql_database = "bgame";
			self::$mysql_user = "root";
			self::$mysql_password = "";
			self::$base="http://localhost/bgame/";
		}else{
			self::$mysql_host = "localhost";
			self::$mysql_database = "bgame";
			self::$mysql_user = "bgame";
			self::$mysql_password = "bg4m3!!!!!!";
			self::$base="http://yoire.com/";
		}
		self::$challsHiddenData=self::$base.self::$challsHiddenDataPath;
	}
}
Config::Init();
?>
