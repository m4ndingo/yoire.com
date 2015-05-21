<?php
class Db{
	public static $lastError;
	private static $con;
	static function CheckDb(){
		$enlace =  mysql_connect(Config::$mysql_host, Config::$mysql_user, Config::$mysql_password);
		if (!$enlace) {
			$lastError='No pudo conectarse: ' . mysql_error();
			return false;
		}
		mysql_close($enlace);
		return true;
	}
	static function connection(){
		if(!isset(self::$con)) self::$con=mysql_connect(Config::$mysql_host, Config::$mysql_user, Config::$mysql_password);
		mysql_select_db(Config::$mysql_database,self::$con);
		return self::$con;
	}
	static function select($table,$fields,$condition="",$order="",$limit=""){
		$res=self::selectAll($table,$fields,$condition,$order,$limit);
		if($res===false) return self::$lastError;
		if(!is_array($res) || !count($res)) return array();
		return $res[0];

	}
	static function selectAll($table,$fields,$condition="",$order="",$limit=""){
		self::$lastError="unknown";
		$where=self::doWhere($condition);
		$order=self::doOrder($order);
		$limit=self::doLimit($limit);
		$query="select $fields from $table".$where.$order.$limit;
		#print $query."<br>";
		$result = mysql_query($query,self::connection());
		if(gettype($result)!="resource") {
			self::$lastError="DB error fetching data...";
			return false;
		}
		if (mysql_errno()) { 
			self::$lastError="MySQL error ".mysql_errno().": ".mysql_error();//."\n<br>When executing:<br>\n$query\n<br>";
			return false;
		}
		$rows=array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $rows[] = $row;
        }
        return $rows;
	}
	static function insert($table,$fields){
		$fieldNames=array();
		$fieldValues=array();
		foreach($fields as $k=>$v){
			array_push($fieldNames,$k);
			array_push($fieldValues,"'".mysql_real_escape_string($v)."'");
		}
		$query="INSERT INTO ".$table." (".join(",",$fieldNames).") VALUES (".join(",",$fieldValues).")";
		//print $query."<br>";
		mysql_query($query,self::connection());
		if (mysql_errno()) { 
			return "MySQL error ".mysql_errno().": ".mysql_error();//."\n<br>When executing:<br>\n$query\n<br>";
		}
	}
	static function update($table,$fields_and_values,$condition=""){
		$fieldNames=array();
		$fieldValues=array();
		$where=self::doWhere($condition);
		$tmp="";
		foreach($fields_and_values as $k=>$v){
			if(strlen($tmp)) $tmp.=",";
			$tmp.=$k."='".mysql_real_escape_string($v)."'";
		}
		$query="UPDATE ".$table." SET ".$tmp.$where;
		//print $query."<br>";
		mysql_query($query,self::connection());
		if (mysql_errno()) { 
			return "MySQL error ".mysql_errno().": ".mysql_error();//."\n<br>When executing:<br>\n$query\n<br>";
		}
	}
	static function doWhere($condition){
		if(!strlen($condition)) return "";
		return " WHERE $condition";
	}
	static function doOrder($order){
		if(!strlen($order)) return "";
		return " ORDER BY $order";
	}
	static function doLimit($limit){
		if(!strlen($limit)) return "";
		return " LIMIT $limit";
	}
}
?>
