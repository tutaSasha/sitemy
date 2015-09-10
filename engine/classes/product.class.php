<?php

class Product extends Core{
	function getTitle(){
		return "Product";

	}
	function getContent(){

		$id = $this->toInteger($_GET["id"]);

		global $mysqli;
		$result_content = "";
		$to =0;
		$limit = QUANTINY_NEWS;
		$page = 1;
		if(isset($_GET["page"])){
			$page_name = $this->toInteger($_GET["page"]);
				if($page_name > 0){
					$page = $page_name;
				}
		}

		$to = $page*$limit-$limit;

		$quantity_all_news = $mysqli->query("SELECT id FROM product WHERE cat_id ='".$id."'");
		$quantity_all_news = $quantity_all_news->num_rows;

		$last_page = $pages = ceil($quantity_all_news/$limit);
		if($page > $last_page){
			$page = $last_page;
			$to = $page*$limit-$limit;
		}

		$product = $mysqli->query("SELECT *
								FROM product 
								WHERE cat_id = '".$id."'
								ORDER BY id DESC 
								LIMIT ".$to." , ".$limit." 
								");
		$rows = $mysqli->assoc($product);

		do{
			$result_content .= $this->getView_product(
					"price" , $rows["price_product"] , 
					"title" , $rows["name_product"] , 
					"content" , $rows["text_product"],
					"img_url", $rows["image_product"],
					"id" , $rows["id"]

				);

		}
		while($rows = $mysqli->assoc($product));

			$result_content .=$this->pageNav($page , $quantity_all_news);

		return $result_content;
	}
}
?>

