
	</br></br>	</br></br>

<div id="login">

		<?	
		if ($this->message!==""){
		echo '<div class=" '.$this->style. '">'.$this->message.'</div>';
		}
	?>
     <center>
		</br></br>

		<form method="post" action="<? echo $_SERVER['PHP_SELF']; ?>?action=Login">

			<fieldset>
					<legend><h3> Authentification </h3></legend>
				<p><label for="email">Login</label></p>
				<p><input id="text" name="nickname" type="text"></p> 

				<p><label for="password">Mot de passe</label></p>
				<p><input type="password" id="password" name="password" ></p> <!-- JS because of IE support; better: placeholder="password" -->

				<p><input type="submit" value="Sign In"></p>

			</fieldset>

		</form>

	</div>
  </center>
