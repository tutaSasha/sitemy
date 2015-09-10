<?php 
error_reporting(-1);
header("Content-Tupe:text/html; charset=utf-8");
require_once("db.class.php");

	$array = array("nameq" => "sasha");
	$array["result_content"] =""; 
	$mysqli = db::getObject();
	$result = $mysqli->query("SELECT * FROM users ");
	if($result->num_rows){
		while($rows=$mysqli->assoc($result)){
			if( $rows["login"] == $_POST["login"])
			$array["result_content"] .= $rows["login"]." login zaniyat<br />";

		}
	}
echo json_encode($array);
 ?>