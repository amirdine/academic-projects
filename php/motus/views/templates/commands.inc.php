<a id="start" class="btn btn-danger" href="<? echo $_SERVER['PHP_SELF'].'?action=StartGame' ?>">Créer une partie</a> 
<button id="currentGameSession"  type="button" class="btn btn-success" >Partie en cours</button>
<button id="scores"  type="button" class="btn btn" >Tableau de Scores</button>
<?
for($i=0; $i<35; $i++)
	echo "&nbsp;";
?>
<a class="btn" href="<? echo $_SERVER['PHP_SELF'].'?action=UpdateUserForm' ?>">Changer de mot de passe</a>

