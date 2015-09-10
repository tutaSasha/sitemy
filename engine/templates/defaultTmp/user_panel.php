
<?php
	$dir_name = str_replace('\\', '/' , dirname(__FILE__));
	$dir_name = str_replace('server', '' , $dir_name);
	$dir_name = $dir_name."engine/classes/db.class.php";

	require_once($dir_name);

?>
<?php 

		function clearString($string){
			return trim(htmlspecialchars(stripcslashes($string)));
		}
				if(isset($_POST["user-auth"])  
				&& isset($_POST["user-password"]) 
				&& isset($_POST["user-name"])){

	
					$login = clearString($_POST["user-name"]);
					$password = clearString($_POST["user-password"]);

						if(!empty($_POST["user-password"]) 
						&& !empty($_POST["user-name"])){
							$res = $mysqli->query(" SELECT id , login , password  , full_name
													FROM users
													WHERE login ='".$login."' AND  password = '$password'
												");
									if($res->num_rows > 0){
										$row = $mysqli->assoc($res);
										$_SESSION["user"] = $row["full_name"];
									
									}


		}
	}

?>
<?php

//unset($_SESSION["user"]);
if(isset($_SESSION["user"])){
	echo '<p>hello '.$_SESSION["user"].'<a href ="?option=logout">EXIT</a>';
}else 
	 echo '


<form method="post">
	<table>
		<tr>
			<td>
				<input type="text" name="user-name" onclick="loginClearValue();" class="user-interface-panel" id="u-name" value="Логин"/> 
			</td>
			<td>
				<input type="password" name="user-password" onclick="passwordClearValue();" class="user-interface-panel" value="Пароль" id="u-password" />
			</td>
			<td>
				<input type="submit" name="user-auth" id="u-auth" value=""  />
			</td>
				<td>

			</td>
		</tr>
	</table>
</form>
';


?>
