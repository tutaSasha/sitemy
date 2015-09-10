<?php
	require_once ROOT.'/engine/classes/db.class.php';

	//$mysqli = db::getObject();
	$mysqli = db::getObject();
	

		$result = $mysqli->query("SELECT id, title FROM category_product");

	if($result && $result->num_rows > 0){

	$rows = $mysqli->assoc($result);
		do
		{

		echo 	'
				<a href = "?option=product&id='.$rows["id"].'">'.$rows["title"].'</a>
				';
		}
		while($rows = $mysqli->assoc($result));
			
	}else
	{
		echo "Меню пустое";
	}
	
?>