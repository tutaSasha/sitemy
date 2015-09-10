<?php

class db {
	private $_db;
	public static $mysqli = null;
	const HOST = 	"localhost";
	const USER = 	"mysql";
	const PASSWORD = 	"mysql";
	const BASE = 	"CMS1";

	function __construct(){
		$ob_mysqli = @new mysqli(self::HOST , self::USER ,self::PASSWORD ,self::BASE);
		if(!$ob_mysqli->connect_error){
			$this->_db = $ob_mysqli;
			$this->_db->query("SET NAMES 'utf-8'");
			return $this->_db;
		}
		else{
			exit("not connect to server");

		}
		}
	public static function getObject(){
		if(self::$mysqli == null){
			$obj = new db();
			self::$mysqli = $obj;

		}
		return self::$mysqli;
	}	

	public function query($sql) {
			return $this->_db->query($sql);
		}
	public function assoc($result) {
			return $result->fetch_assoc();
		}
		
}

?>

