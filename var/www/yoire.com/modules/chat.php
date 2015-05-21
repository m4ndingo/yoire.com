<?php
class Chat{
	function defaultMethod(){
		return Template::load(__CLASS__,"default.php");
	}
	function title(){return "Chat";}
	function send(){
		$data=Common::getPost("data");
		if(!strlen($data)) return;
		$data.=PHP_EOL;
		$login=Session::get("login")?Session::get("login"):"Anonymous";
		$time=@date("H:i:s");
		$data="[$time] $login> "." ".$data;
		file_put_contents("chat.sent.txt", $data);

		if(!file_exists("chat.old.txt")) copy("chat.sent.txt","chat.old.txt");

		copy("chat.new.txt","chat.old.txt");
		file_put_contents("chat.new.txt",file_get_contents("chat.old.txt").$data);
		copy("chat.new.txt","chat.txt");
	}
	function log(){
		header("Content-Type: text/plain");
		print @file_get_contents("chat.txt");die;
	}
	function updated(){
		Online::ping();
		header("Content-Type: text/plain");
		$chat=file_get_contents("chat.txt");
		$start=substr(strrchr($chat,"["),1);
		if(preg_match("/(\d+:\d+:\d+)\]/",$start,$m)) print $m[1];
		die;
	}
}
?>