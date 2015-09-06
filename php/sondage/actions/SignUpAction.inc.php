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

			$nickname = $_POST['signUpLogin'];
			$password =  $_POST['signUpPassword'];
			$confirmation =  $_POST['signUpPassword2'];

			if($password != $confirmation){
			
			    $this->setView(getViewByName("SignUpForm"));
			    $this->getView()->setMessage("Le mot de passe et sa confirmation sont différents.", 'alert-error"');
				return false ;
			}

			if($this->database->addUser($nickname, $password) != "true"){
			
			  $message = $this->database->addUser($nickname, $password); 
			  $this->setView(getViewByName("SignUpForm"));
			  $this->getView()->setMessage($message, 'alert-error');
			  return false ;
			}
			

			$this->database->addUser($nickname, $password);
 			$this->setMessageView("Inscription validé, vous pouvez dès à présent vous connecter sur le site en utilisant vos identifiants", 
 			                      "alert-success");


		return true;
		/* TODO END */
	}

	private function setSignUpFormView($message) {
		$this->setView(getViewByName("SignUpForm"));
		$this->getView()->setMessage($message);
	}

}


?> 
