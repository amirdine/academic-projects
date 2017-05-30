<?

require_once("actions/Action.inc.php");

class AddSurveyFormAction extends Action {

	
	public function run() {
		
	  /**
		* Permet d'afficher le formulaire d'ajout d'un sondage.
      */

		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}
		
		$this->setView(getViewByName("AddSurveyForm"));
	
	
  }
   
   
 
}
?>
