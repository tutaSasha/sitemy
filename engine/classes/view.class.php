<?php

class View extends Core{
	private $_title_news = "";

	function getTitle(){
		if(!isset($this->_title_news)){
			return "New";
		}else 
		return $this->_title_news;

	}
	function getContent(){
		global $mysqli;
		$result_content = "";
		$id=$this->toInteger($_GET["id_news"]);

		$res = $mysqli->query("	SELECT * FROM news WHERE id = '".$id."'");

		if($res->num_rows > 0){

			$row = $mysqli->assoc($res);
			$this->_title_news = $row["title"];
			$result_content .= "<h2>NAME TITLE".$row["title"]."</h2>";
			$result_content .= "<div ><h2>TEXT NEWS".$row["text"]."</h2></div>";
			$result_content .= '<p style ="backgraund: #0333 : padding: 8px : color: #fff :">DATE   '.$row["date"]."</p>";
			

		}
		return $result_content;
}
}


?>

