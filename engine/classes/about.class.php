<?php

class About extends Core{
	private $_title = "";
	private $_text = "";

	function getTitle(){
		global $mysqli;
			$res = $mysqli->query("SELECT * FROM pages WHERE name = 'about'");
			if($res->num_rows == 1){
				$rows=$mysqli->assoc($res);
				$this->_title = $rows["title"];
				$this->_text = $rows["text"];
			}
		return $this->_title;

	}
	function getContent(){

		$r = "<h1>".$this->_title."</h1><br />".$this->_text;

	


		return $r ;
	}
}





?>

