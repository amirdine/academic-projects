<?

require_once("actions/Action.inc.php");

class GetMySurveysAction extends Action {

	/**
	 * Construit la liste des sondages de l'utilisateur et le dirige vers la vue "ServeysView" 
	 * de façon à afficher les sondages.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO START */

		
	if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}
      
	  	$owner   = $this->getSessionLogin();
 	    $surveys = $this->database->loadSurveysByOwner($owner);
   
	   $this->setView(getViewByName("Surveys"));
	   $this->getView()->setSurveys($surveys);

		/* TODO END */
	}

}

?>
