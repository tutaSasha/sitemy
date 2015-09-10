<?php
class Registration extends Core{

	function getTitle(){
		
		return "REGISTRATION";

	}
	function getContent(){
		global $mysqli;

		$result_content = "";

		$error = array();

		if(isset($_POST["reg-user"]) 
			&& isset($_POST["login"]) 
			&& isset($_POST["full_name"]) 
			&& isset($_POST["pass"])
			&& isset($_POST["r-pass"])
			&& isset($_POST["email"])){
			  if(!empty($_POST["login"]) 
			  	&& !empty($_POST["full_name"])
			  	&& !empty($_POST["pass"])
			  	&& !empty($_POST["r-pass"])
			  	&& !empty($_POST["email"])){
			  		if(($_POST["pass"] !== $_POST["r-pass"])){
			  			$error["pass"] = "Пароли не совпадают";
					}
					if(!(filter_var($_POST["email"] , FILTER_VALIDATE_EMAIL))){
			  			$error["email"] = "Не действителен";
					}
					if(!count($error)){
						$res = $mysqli->query("SELECT login , password , email 
												FROM users 
												WHERE logig = '".$_POST["login"]."' 
												AND password = '".$_POST["pass"]."'
												AND email = '".$_POST["email"]."' ");
						if($res->num_rows){
							$result_content .= "Какого хера";
							exit;
						}else{
							$login = $_POST["login"];
							$full_name = $_POST["full_name"];
							$pass = $_POST["pass"];
							$email = $_POST["email"];
							$dataq = date("Y-m-d") ; 
							$mysqli->query("INSERT INTO `users` SET
													`login` = '".$login."',
													`full_name` = '".$full_name."',
													`password` = '".$pass."',
													`email` = '".$email."',
													`date_id` = '".$dataq."'
													
													");
							$_SESSION["user"] = $login;
						}
					}


							
				}

//$mysqli->insert_id
		}else{echo "bad";}
if(!isset($_SESSION["user"])){
		$result_content .= '
				</script>
		<script type="text/javascript" >
		$(document).ready(function(){
		var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
		$("#f_mail").change(function(){
		var r=$("#f_mail").val();
		if (!reg.test(r)) {
		$("#f_mail").css("backgroundColor", "red");
		}
		else{
		$("#f_mail").css("backgroundColor", "white");   
		}
		});
		});/*end ready*/
		</script>
		<script type="text/javascript">

	function password (){
	if(document.getElementById("10").innerHTML != ""){
		document.getElementById("10").innerHTML = "";
	};
if(document.getElementById("password").value != document.getElementById("passwordd").value ){
	document.getElementById("10").innerHTML = "password not correct";
}
};
</script>
			<form method = "post">			
					<p class = "form-element"><span>login</span><input type = "text" name = "login" id = "login" onkeyup = "myAjax();" value = "" ><h3 id = "3"></h3></>
					<p class = "form-element"><span>full_name</span><input type = "text" name = "full_name" ></>
		
					<p class = "form-element"><span>email</span><input type = "text" name = "email" id = "f_mail"></>					

				<p class = "form-element"><span>pass</span>
							<input type = "password" name = "pass" id = "password" value = "" >
				</>
					<p class = "form-element"><span>r-pass</span>
							<input type = "password" name = "r-pass" id = "passwordd" onkeyup = "password();" value = "">
					<p id= "10"></p></>
						<p class = "form-element"><input id = "reg-user-btn" type = "submit" name = "reg-user" ></>
				';}
				return $result_content ;
}
}


?>

