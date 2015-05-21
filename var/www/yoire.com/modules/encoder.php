<?php
class Encoder{
	static function asc2bin($in)
	{
		 $in=utf8_encode($in);
		 $out = '';
		 for ($i = 0, $len = strlen($in); $i < $len; $i++)
		 {
			$out .= sprintf("%08b",ord($in{$i}));
		 }
		 return $out;
	}
	static function bin2asc($in)
	{
		 $out = '';
		 for ($i = 0, $len = strlen($in); $i < $len; $i += 8)
		 {
			$out .= chr(bindec(substr($in,$i,8)));
		 }
		 return $out; 
	}
	static function transform($data,$from,$to){
		$total=count($from);
		for($i=0;$i<$total;$i++){
			$data=preg_replace("/".preg_quote($from[$i],"/")."/",$to[$i],$data);
		}
		return $data;
	}
	static function asc2hex($in,$utf_encode=true){
		 if($utf_encode) $in=utf8_encode($in);
		 $out = '';
		 for ($i = 0, $len = strlen($in); $i < $len; $i++)
		 {
			$out .= sprintf("%02x",ord($in{$i}));
		 }
		 return $out;
	}
	static function hex2asc($in,$utf8_decode=true){
		 $out = '';
		 for ($i = 0, $len = strlen($in); $i < $len; $i += 2)
		 {
			$out .= chr(hexdec(substr($in,$i,2)));
		 }
		if($utf8_decode) return utf8_decode($out); 
		return $out;
	}
	static function data2hex($in){
		return self::asc2hex($in,false);
	}
	static function hex2data($in){
		return self::hex2asc($in,false);
	}
	static function data2base64($in,$utf_encode=true){
		 if($utf_encode) $in=utf8_encode($in);
		 return base64_encode($in);
	}
	static function base642data($in,$utf_decode=true){
		 if($utf_decode) $in=utf8_decode($in);
		 return base64_decode($in);
	}
}
?>