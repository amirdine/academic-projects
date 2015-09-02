<?

require_once("actions/Action.inc.php");
require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");

class GetResultSurveyAction extends Action {

	

	public function run() {

	  /** 
      * Permet d'afficher les résultats du sondage
      */ 
		
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}

		$surveyID = $_GET['id'];
		$database       = new Database();

		if($database->surveyNotExist($surveyID)){
			$this->setMessageView("Désolé, ce sondage n'existe pas. ", "alert-warning");
			return ;
		}

		$responses = $database->getResponse($surveyID);	
		$survey    = $database->getSurvey($surveyID);

		$user      = $this->getSessionLogin();
		$author	  = $survey->getAuthor();
   
		if($author != $user){
			$this->setMessageView("Vous n'avez pas accès au résultat de ce sondage ", "alert-danger");
			return ;
		}

		$survey->addResponses($responses);

		$this->setView(getViewByName("ResultSurvey"));
	   $this->getView()->setSurvey($survey);

	}


}

?>
