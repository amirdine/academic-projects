<?


require_once("actions/Action.inc.php");

class AddSurveyAction extends Action {

	
	public function run() {

	  /**
		* Permet d'ajouter un sondage dans la base de données
      */
	
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}
	
		$meetingSubject = $_POST["meetingSubject"];
		$comment 		 = $_POST["comment"];


		if($this->IsNullOrEmptyString($meetingSubject)){
			$this->setAddSurveyFormView("Vous devez indiquer le sujet de la réunion");
			return;
		}

		$database       = new Database();

   	$survey   = new Survey();
		$author   = $this->getSessionLogin();
		$database->insertSurvey($survey->getID(), $meetingSubject, $comment, $author);

	   $cpt = 0;

		for($i = 1; $i < 6 ; $i++){
		
			$day          =   htmlentities($_POST["timeSlotDate$i"]);
	
			$start_hour   =   htmlentities($_POST["startHour$i"]);
			$start_minute =   htmlentities($_POST["startMinute$i"]);

			$end_hour     =   htmlentities($_POST["endHour$i"]);
			$end_minute   =   htmlentities($_POST["endMinute$i"]);

			
      	if($start_hour != "null" && $end_hour != "null" && $start_minute != "null" && $end_minute != "null"){
			   $cpt =  $cpt +1;
	 		}
		}

		if($cpt == 0){
			$this->setAddSurveyFormView("Vous devez ajouter des horaires");
			return;
		}


		for($i = 1; $i < 6 ; $i++){

			$day          =   htmlentities($_POST["timeSlotDate$i"]);
	
			$start_hour   =   htmlentities($_POST["startHour$i"]);
			$start_minute =   htmlentities($_POST["startMinute$i"]);

			$end_hour     =   htmlentities($_POST["endHour$i"]);
			$end_minute   =   htmlentities($_POST["endMinute$i"]);


      	if($start_hour != "null" && $end_hour != "null" && $start_minute != "null" && $end_minute != "null"){
			
				$start = new DateTime("$day $start_hour:$start_minute");
				$end   = new DateTime("$day $end_hour:$end_minute");
  	
				$timeSlot = new TimeSlot($start, $end);
				$database->insertTimeSlot($timeSlot, $survey->getID());
	 		}
  		}
	
	   $url       = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=GetSurvey&id=".$survey->getID(); 
		$link      = "<a href=\"$url\"> $url</a>";
      $mesage    = "Merci, nous avons ajouté votre sondage </br> Lien:   $link ";
	   
		$this->setMessageView( $mesage, "alert-success");
  }
   
	private function setAddSurveyFormView($message) {
		$this->setView(getViewByName("AddSurveyForm"));
		$this->getView()->setMessage($message, "alert-error");
	}

	private function IsNullOrEmptyString($string){
    return (!isset($string) || trim($string)==='');
	}

}

?>
