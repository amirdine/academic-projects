<?
class Comment {
	
	private $id;
	private $survey;
	private $owner;
	private $message;
	private $date;
	

	public function __construct($id_survey, $message, $owner) {
		$this->id = null;
		$this->id_survey = $id_survey;
		$this->message = $message;
		$this->owner = $owner;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getMessage(){
		return $this->message;
	}

	public function getOwner(){
		return $this->owner;
	}

	public function getSurveyId() {
		return $this->id_survey;
	}

	public function setDate($date){
		$this->date = $date;	
	}
	
	public function getDate(){
		return $this->date;		
			
	}
}
?>
