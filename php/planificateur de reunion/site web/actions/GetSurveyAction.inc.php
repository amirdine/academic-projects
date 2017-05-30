<?

require_once("actions/Action.inc.php");

class GetSurveyAction extends Action {
  
 
	public function run() {

	  /** 
   	* Permet d'afficher un sondage 
	   */
		$surveyID = $_GET['id'];

		$database = new Database();

		if($database->surveyNotExist($surveyID)){
			$this->setMessageView("Désolé, ce sondage n'existe pas. ", "alert-warning");
			return ;
		}

		$survey = $database->getSurvey($surveyID);
		$this->setView(getViewByName("Survey"));
	   $this->getView()->setSurvey($survey);
	
		
  
   }
   
	
	

	

}

?>
