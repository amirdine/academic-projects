<?

require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");
require_once("actions/Action.inc.php");

class DeleteSurveyAction extends Action {


	public function run() {
	
	if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}
		
	$id_survey = $_POST['surveyId'];
   	
   	$query = $this->database->deleteSurvey($id_survey);
   	if(! $query){
   	$this->setMessageView("Erreur lors de la suppression du sondage dans la base de données.", "alert-error");
   	return false;
   	}
   	
   	$this->setMessageView("Merci, nous avons supprimer votre sondage.", "alert-success");
  	return true;
      
 
	}

	private function setAddSurveyFormView($message) {
		$this->setView(getViewByName("AddSurveyForm"));
		$this->getView()->setMessage($message, "alert-error");
	}

}

?>
