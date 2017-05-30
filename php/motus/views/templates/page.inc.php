<!DOCTYPE html>
<html lang="fr">
  <head>
		<meta charset="utf-8">
		<title>Jeu</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	    <link rel="stylesheet" type="text/css" href="css/style.css" />
		    <script type="text/javascript" src="script/jquery/jquery-1.9.1.min.js"></script>
			<script type="text/javascript" src="script/script.js"></script>

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
