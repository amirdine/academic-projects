<?

require_once("actions/Action.inc.php");

class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot clé
	 * contenu dans la variable $_POST["keyword"]. L'utilisateur est ensuite 
	 * dirigé vers la vue "ServeysView" permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */
    
		$keyword = $_POST["keyword"];

		if(!isset($keyword) || trim($keyword)===''){
			$this->setMessageView("Vous devez entrer un mot clé avant de lancer la recherche.", "alert-error");
			return false;
		}

		$surveys = $this->database->loadSurveysByKeyword($keyword);
		$this->setView(getViewByName("Surveys"));
	   $this->getView()->setSurveys($surveys);
		


		/* TODO END */
	}

}

?>
