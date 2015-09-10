<?php

class View_product extends Core{
	private $_title_news = "";

	function getTitle(){
		if(!isset($this->_title_news)){
			return "Product";
		}else 
		return $this->_title_news;

	}
	function getContent(){
		global $mysqli;
		$result_content = "";
		$id=$this->toInteger($_GET["id"]);

		$res = $mysqli->query("	SELECT * FROM product WHERE id = '".$id."'");

		if($res->num_rows > 0){

			$row = $mysqli->assoc($res);
			$this->_title_news = $row["name_product"];
			$result_content .= '<img src="./server/images/'.$row["image_product"].'" />"';
			$result_content .= "<h2>Price---".$row["price_product"]."  uah</h2>";
			$result_content .= "<h2>NAME TITLE".$row["name_product"]."</h2>";
			$result_content .= "<div ><h2>TEXT NEWS".$row["text_product"]."</h2></div>";
			$result_content .= '<p style ="backgraund: #0333 : padding: 8px : color: #fff :">DATE </p>';
			

		}
		return $result_content;
}
}


?>

