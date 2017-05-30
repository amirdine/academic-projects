<?

require_once("actions/Action.inc.php");

class SignUpAction extends Action {

	/**
	 * Traite les données envoyées par le formulaire d'inscription
	 * ($_POST['signUpLogin'], $_POST['signUpPassword'], $_POST['signUpPassword2']).
	 *
	 * Le compte est crée à l'aide de la méthode 'addUser' de la classe Database.
	 *
	 * Si la fonction 'addUser' retourne une erreur ou si le mot de passe et sa confirmation
	 * sont différents, on envoie l'utilisateur vers la vue 'SignUpForm' contenant 
	 * le message retourné par 'addUser' ou la chaîne "Le mot de passe et sa confirmation 
	 * sont différents.";
	 *
	 * Si l'inscription est validée, le visiteur est envoyé vers la vue 'MessageView' avec
	 * un message confirmant son inscription.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */

			$login = htmlentities($_POST['signUpLogin']);
			$password =  htmlentities($_POST['signUpPassword']);
			$confirmation =  htmlentities($_POST['signUpPassword2']);

			if($password != $confirmation){
			
			  $this->setView(getViewByName("SignUpForm"));
			  $this->getView()->setMessage("Le mot de passe et sa confirmation sont différents.", 'style=font-size:14pt');
				return false ;
			}

			if($this->database->addUser($login, $password) != "true"){
			
			  $message = $this->database->addUser($login, $password); 
			  $this->setView(getViewByName("SignUpForm"));
			  $this->getView()->setMessage($message, 'style=font-size:14pt');
			  return false ;
			}
			

			$this->database->addUser($login, $password);
 			$this->setMessageView("Inscription validé, vous pouvez dès à présent vous connecter sur le site en utilisant vos identifiants", "alert-success");



		/* TODO END */
	}

	private function setSignUpFormView($message) {
		$this->setView(getViewByName("SignUpForm"));
		$this->getView()->setMessage($message);
	}

}


?> 
