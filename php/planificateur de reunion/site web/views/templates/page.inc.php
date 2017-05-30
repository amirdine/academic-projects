<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<title>Sondages</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
		<script language="javascript" type="text/javascript" src="js/jquery/themes/blue/style.css"></script>	
 		<script language="javascript" type="text/javascript" src="js/jquery/js/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery/js/jquery-ui.min.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery/js/jquery.validate.min.js"></script>
		<script language="javascript" type="text/javascript" src="js/jquery/js/additional-methods.min.js"></script>
		<link	type="text/css"	href="js/jquery/css/ui-lightness/jquery-ui-1.10.2.custom.css"	rel="stylesheet">	
		<script language="javascript" type="text/javascript" src="js/script.js"></script>
		 <meta name="detectify-verification" content="4d7d1d9895d6f8b319dedc60ca99868a" />
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<? 
					if ($this->login===null) $this->displayLoginForm();
					else $this->displayLogoutForm();
				?>
			</div>
		</div>
	</div>
	
<? 
	$this->displayBody(); 
?>

</body>
</html>
