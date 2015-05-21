<?php
class Wechall{
	function defaultMethod(){die;}
	function title(){return "Wechall connector";}
	function validatemail(){
		if (!isset($_GET['username']) || !isset($_GET['email']) || is_array($_GET['username']) || is_array($_GET['email']) ) { 
			die('0'); 
		}
		Db::connection();
		$uname = mysql_real_escape_string(Common::getString('username'));
		$email = mysql_real_escape_string(Common::getString('email'));
		$res=Db::select("members","1","login='$uname' AND email='$email'");
		if(!count($res) || $res===false) die("0");
		die("1");
	}
	function userscore(){
		$nick=Common::getString('username');
		Db::connection();
		$uname = mysql_real_escape_string($nick);
		$res=Db::select("members","1","login='$uname'");
		if(!count($res) || $res===false) die();

		$maxscore = 10000;
		$rank = 10-Rankings::level($nick);
		$score = $maxscore*Challenges::percentageSolved($nick)/100;
		$challsolved = count(Rankings::solvedByMember($nick));
		$challcount = count(Challenges::retrieveChallenges());
		$usercount = Members::count();

		# Now output the data.
		die(sprintf('%s:%d:%d:%d:%d:%d:%d', htmlentities(Common::getString("username")), $rank, $score, $maxscore, $challsolved, $challcount, $usercount));
	}
}
?>