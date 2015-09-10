<?php

class logout extends Core{


	function getTitle(){
		
		return "EXIT";

	}
	function getContent(){
		unset($_SESSION["user"]);
		header("Location: ?option=index");
}
}


?>

