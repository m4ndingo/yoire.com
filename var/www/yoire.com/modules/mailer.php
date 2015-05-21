<?php
class Mailer{
	static function sendToWebmaster($from,$subject,$message){
		$headers = "From: ".$from.PHP_EOL.
			"X-Mailer: PHP/" . phpversion().PHP_EOL.
			"Content-type: text/plain; charset=UTF-8";
		$res=@mail(Config::$webmaster_email,"Contact_yoire.com ".$subject,utf8_encode($message),$headers);
		return $res;
	}
	static function sendFromWebmaster($to,$subject,$message){
		$headers = "From: ".Config::$webmaster_email.PHP_EOL.
			"X-Mailer: PHP/" . phpversion().PHP_EOL.
			"Content-type: text/html; charset=UTF-8";
		$res=@mail($to,$subject,utf8_encode($message),$headers);
		return $res;
	}
}
?>
