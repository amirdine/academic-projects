<?

require_once("actions/Action.inc.php");

class LoginAction extends Action {

			
	/**
	 * Traite les données envoyées par le visiteur via le formulaire de connexion
	 * (variables $_POST['nickname'] et $_POST['password']).
	 * Le mot de passe est vérifié en utilisant les méthodes de la classe Database.
	 * Si le mot de passe n'est pas correct, on affiche le message "Pseudo ou mot de passe incorrect."
	 * Si la vérification est réussie, le pseudo est affecté à la variable de session.
	 *
	 * @see Action::run()
	 */
	public function run() {

		$nickname  =  $_POST['nickname'];
		$password  =  $_POST['password'];

		if( !$this->database->checkPassword($nickname, $password)){
			$this->setMessageView("Pseudo ou mot de passe incorrect.", "alert-error");
			return false;
		}

		$login = $nickname;
		$this->setSessionLogin($login);
		$this->setView(getViewByName("Message"));
		$this->getView()->setMessage("connexion réussie", "alert-success");

	}
	  

}

?>
