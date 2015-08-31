<?

require_once("actions/Action.inc.php");

class UpdateUserAction extends Action {

	/**
	 * Met à jour le mot de passe de l'utilisateur en procédant de la façon suivante :
	 *
	 * Si toutes les données du formulaire de modification de profil ont été postées
	 * ($_POST['updatePassword'] et $_POST['updatePassword2']), on vérifie que
	 * le mot de passe et la confirmation sont identiques.
	 * S'ils le sont, on modifie le compte avec les méthodes de la classe 'Database'.
	 *
	 * Si une erreur se produit, le formulaire de modification de mot de passe
	 * est affiché à nouveau avec un message d'erreur.
	 *
	 * Si aucune erreur n'est détectée, le message 'Modification enregistrée.'
	 * est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */
		
			$nickname = $this->getSessionLogin();
			$password =  $_POST['updatePassword'];
			$confirmation =  $_POST['updatePassword2'];
			
			if($password != $confirmation){
			
			  $this->setView(getViewByName("UpdateUserForm"));
			  $this->getView()->setMessage("Le mot de passe et sa confirmation sont différents.", 'alert-error');
				return false ;
			}
				
			$query = $this->database->updateUser($nickname, $password);
			if(!$query){
				$this->setView(getViewByName("UpdateUserForm"));
				$this->setMessageView("Erreur lors de la mise à jour de votre mot passe dans la base de données.", "alert-error");
				return false;
			}
			
			$this->setView(getViewByName("UpdateUserForm"));
			$this->setMessageView("Modification enregistrée", "alert-success");
						
			return true;
			}
			
		
		/* TODO END */
	



	private function setUpdateUserFormView($message) {
		$this->setView(getViewByName("UpdateUserForm"));
		$this->getView()->setMessage($message, "alert-error");
	

}
}
?>
