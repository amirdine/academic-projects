<form class="navbar-form pull-right" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>?action=Login" >
  <a class="btn btn-danger" href="<? echo $_SERVER['PHP_SELF'].'?action=SignUpForm';?>">Inscription</a>
	<input class="span2" placeholder="Login" name="login" type="text" autocomplete="off" />
	<input class="span2" placeholder="Mot de passe" name="password"	type="password" autocomplete="off"/>
	<input class="btn" name="connexionConnexion" type="submit" value="Connexion" />
</form>

