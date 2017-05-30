<?

require_once("actions/Action.inc.php");

class AnswerSurveyAction extends Action {


	public function run() {

 	/** 
    * Permet  à une personne de répondre à un sondage
    */
	
		$name      =  $_POST['FirstName'];
 		$responses =  $_POST['response']; // checkbox
   	$surveyID  =  $_POST['survey_id'];

      $this->database->insertResponse($responses, $surveyID, $name);
      $this->setMessageView("Vos réponses ont été enregistrée ", "alert-success");
	}

}

?>
