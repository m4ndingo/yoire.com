<?php
class Smiley{
	static function start($smiley){
		//$smiley=preg_replace("/(q)/","{hat}$1{.hat}",$smiley);
		$smiley=preg_replace("/(;|:|8|\^)/","{eyes}$1{.eyes}",$smiley);
		$smiley=preg_replace("/('|\"|_)/","{tear}$1{.tear}",$smiley);
		$smiley=preg_replace("/(-|=)/","{nose}$1{.nose}",$smiley);
		$smiley=preg_replace("/(\)|\(|D|p|P|\/|O|\|)/","{mouth}$1{.mouth}",$smiley);
		$smiley=preg_replace("/(X)/","{mouth_eyes}$1{.mouth_eyes}",$smiley);
		return $smiley;
	}
	static function end($smiley){
		//$smiley=preg_replace("/{hat}/","<font color=#d6f><b>",$smiley);
		$smiley=preg_replace("/{.hat}/","</font></b>",$smiley);
		$smiley=preg_replace("/{eyes}/","<font color=#88f><b>",$smiley);
		$smiley=preg_replace("/{.eyes}/","</font></b>",$smiley);
		$smiley=preg_replace("/{tear}/","<font color=cyan><b>",$smiley);
		$smiley=preg_replace("/{.tear}/","</font></b>",$smiley);
		$smiley=preg_replace("/{nose}/","<font color=yellow><b>",$smiley);
		$smiley=preg_replace("/{.nose}/","</font></b>",$smiley);
		$smiley=preg_replace("/{mouth}/","<font color=red><b>",$smiley);
		$smiley=preg_replace("/{.mouth}/","</font></b>",$smiley);
		$smiley=preg_replace("/{mouth_eyes}/","<font color=#f0f><b>",$smiley);
		$smiley=preg_replace("/{.mouth_eyes}/","</font></b>",$smiley);
		return $smiley;
	}
	static function build($smiley){
		$smiley=self::start($smiley);
		$smiley=self::end($smiley);
		return $smiley;
	}
}
?>