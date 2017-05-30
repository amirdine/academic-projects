<?

require_once("actions/Action.inc.php");
require_once("model/Comment.inc.php");

class CommentAction extends Action {

	/**
	 * Récupère l'identifiant de la réponse choisie par l'utilisateur dans la variable
	 * $_POST["responseId"] et met à jour le nombre de voix obtenues par cette réponse.
	 * Pour ce faire, la méthode 'vote' de la classe 'Database' est utilisée.
	 * 
	 * Si une erreur se produit, un message est affiché à l'utilisateur lui indiquant
	 * que son vote n'a pas pu être pris en compte.
	 * 
	 * Sinon, un message de confirmation lui est affiché.
	 *
	 * @see Action::run()
	 */	
	public function run() {

		
	if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié pour poster un commentaire", "alert-error");
			return;
	}

		$owner   = $this->getSessionLogin();
		$message =   $_POST['commentaire'];
		$id_survey = $_POST['surveyId'];

	
	
		$comment = new Comment($id_survey, $message, $owner);
		$r = $this->database->saveComment($comment);
		if(!$r ){
		$this->setMessageView("Erreur lors de l'ajout de votre commentaire dans la base de données", "alert-error");
			return false;
		}
		
		$this->setMessageView("Commentaire ajouté.", "alert-success");
	}

}
?>
