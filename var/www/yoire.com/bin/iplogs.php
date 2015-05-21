#!/usr/bin/php
<?php

include("rules.class.php");

$rules=Rules::getRules();

$color=array("red"=>"\033[31m","default"=>"\033[0m");

$op=getopt("aedr",array("ip:","v:"));

if(!count($op)) help();

if(isset($op["r"])) die(var_dump($rules));
if(!isset($op["ip"]) && !isset($op["v"]) && !isset($op["d"])) die("--ip <address>, -d or -v required...".PHP_EOL);
if(!isset($op["a"]) && !isset($op["e"])) die("-a for 'access.log'".PHP_EOL."-e for 'error.log'".PHP_EOL);

#var_dump($op);die;

$log="";

if(isset($op["a"])) $log =file_get_contents("/var/log/apache2/yoire.com-access.log");
if(isset($op["e"])) $log.=file_get_contents("/var/log/apache2/yoire.com-error.log");

print "Log size: ".strlen($log)." bytes\n";

if(isset($op["d"])) {
	$a_search=array();
	foreach($rules as $rule){
		foreach($rule["search"] as $search){
			array_push($a_search,"/(".preg_quote($search,"/")."[^\s]*)/i");
		}	
	}
	usort($a_search,"lensort");
	$log=preg_replace(
			$a_search,
			$color["red"]."$1".$color["default"],
			$log
		);
	print $log;
	die;
}

foreach(preg_split("/".PHP_EOL."/",$log) as $line){
	if(isset($op["ip"]) && !preg_match("/".preg_quote($op["ip"])."/",$line)) continue;
	if(isset($op["v"])  &&  preg_match("/".$op["v"]."/",$line)) continue;
	print $line.PHP_EOL;
}
function lensort($a,$b){
	return strlen($a)<strlen($b);
}
function help(){
print "-d           dump all\n";
print "-a           access.log\n";
print "-e           error.log\n";
print "--ip <addr>  filter by ip address\n";
print "--v <regexp> remove matching results\n";
print "-r           dump rules\n";
die;
}
?>
