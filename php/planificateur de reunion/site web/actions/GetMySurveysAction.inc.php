<?

require_once("actions/Action.inc.php");

class GetMySurveysAction extends Action {

	
	public function run() {
		
	  /** 
      * Permet d'afficher tous les sondages d'un utilisateur
      */ 
		
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}
      
		$author   = $this->getSessionLogin();	   
		$surveys  = $this->database->getSurveysIDByAuthor($author);
   
	   $this->setView(getViewByName("Surveys"));
	   $this->getView()->setSurveys($surveys);
	}

}

?>
