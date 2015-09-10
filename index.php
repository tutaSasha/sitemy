<?php
error_reporting(-1);
header('Content-Type:text/html ; charset=utf-8');
	$dir_name = str_replace('\\', '/' , dirname(__FILE__));
	define('ROOT' , $dir_name);
	define("QUANTINY_NEWS" , 2);

/*




sdfgnrggbfrtnbfr
*/
	require_once ROOT.'/engine/classes/core.class.php';
	require_once ROOT.'/engine/classes/db.class.php';
require_once ROOT.'/engine/classes/category.class.php';
	try {
		$option = "index";
		if(isset($_GET["option"])){
			$opt = $_GET["option"];
			$path = ROOT.'/engine/classes/'.$opt.".class.php";
			if(file_exists($path)){
				require_once $path;
				if(class_exists($opt)){
					$option = $_GET["option"];
				}
			}
		}

		$full_path = ROOT.'/engine/classes/'.$option.'.class.php';		
	
		require_once $full_path;

		$view = new $option();
		$mysqli = db::getObject();
		$view->getBody();

		
	} catch(Exception $e) {

		echo $e->getMessage();

		
	}

?>

