<?php 
class Search extends Core{
	function getTitle(){
		return "Page name";

	}
	function getContent(){
		$q =htmlspecialchars(trim(stripslashes($_GET["q"])));
		$result_content = "";
		if(!$q){
			return $result_content;
		}
		global $mysqli;
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

		$quantity_all_news = $mysqli->query("SELECT title FROM news WHERE title LIKE '%".$q."%' ");
		$quantity_all_news = $quantity_all_news->num_rows;

		$last_page = $pages = ceil($quantity_all_news/$limit);
		if($page > $last_page){
			$page = $last_page;
			$to = $page*$limit-$limit;
		}

		$news = $mysqli->query("SELECT id, title, description , img_url FROM news 
			WHERE title LIKE '%".$q."%'
			ORDER BY id DESC LIMIT ".$to." , ".$limit."");
		if(!$news){
			return $result_content;
		}
		$rows = $mysqli->assoc($news);
		if(!$rows){
			return $result_content;
		}

		do{
			$result_content .= $this->getView(
					"title" , $rows["title"] , 
					"content" , $rows["description"],
					"img_url", $rows["img_url"],
					"id" , $rows["id"]

				);

		}
		while($rows = $mysqli->assoc($news));

			$result_content .=$this->pageNav($page , $quantity_all_news);

		return $result_content;
	}
}





?>

