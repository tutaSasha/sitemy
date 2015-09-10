<!DOCTYPE html>
<html>
	<head>
		<title>%title%</title>
		<meta charset='UTF-8' />
		<meta http-equiv="description" content="%meta_d%" />
		<meta http-equiv="keywords" content="%meta_k%" />
		<script type="text/javascript" src="%root%/js/jquery.js"></script>
		<script type="text/javascript" src = "%root%/js/jquery-1.2.6.js"></script>
		<link href="%root%/css/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src = "jquery-1.2.6.js"></script>

 <script>
function myAjax(){
	$.ajax({
		url: "ajax.php",
		type : "POST",
		cache : false,
		data:{login:document.getElementById("login").value , key2:"111"},
		success:function(msg){
			var response = JSON.parse(msg);
			
			document.getElementById("3").innerHTML = response.result_content;

		},
	});
}

</script>

	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="menu-gorizontal">
					%menu%
				</div>
				<div id="logo"></div>
				<div id="search">
						%search%
				</div>
				<div id="user-panel">
					%user_panel%
				</div>
			</div>
			<div id="middle">
				<div id="sidebar">
					%sidebar%
				</div>
				<div id="content">
					%content%
				</div>
				<div id="footer">
					%footer%
				</div>
			</div>
		</div>
		<script type="text/javascript" src="%root%/js/sidebar.js"></script>
		<script type="text/javascript" src="%root%/js/userpanel.js"></script>
	</body>
</html>