<?php
class Crypt{
	static function XorData($in,$kvals,$utf_encode=false){
		 if($utf_encode) $in=utf8_encode($in);
		 $out = '';
		 if(strlen($kvals)%2==1 || !strlen($kvals)) return "Invalid key length... must be even...";
		 for ($i = 0, $len = strlen($in); $i < $len; $i++)
		 {
			$val    = ord($in{$i});
			$kstart =($i*2)%strlen($kvals);
			$key    = hexdec(substr($kvals,$kstart,2));
			$out .= chr($val^$key);
		 }
		 return $out;
	}
	static function AndData($in,$kvals,$utf_encode=false){
		 if($utf_encode) $in=utf8_encode($in);
		 $out = '';
		 if(strlen($kvals)%2==1) return "Invalid key length... must be even...";
		 for ($i = 0, $len = strlen($in); $i < $len; $i++)
		 {
			$val    = ord($in{$i});
			$kstart =($i*2)%strlen($kvals);
			$key    = hexdec(substr($kvals,$kstart,2));
			$out .= chr($val&$key);
		 }
		 return $out;
	}
}
?>