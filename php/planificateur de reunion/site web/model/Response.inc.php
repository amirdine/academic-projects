<?

class Response {
	
	private $id;
	private $timeSlot;
	private $user;
   private $disponibility;

	
	public function __construct($id, $timeSlot, $user, $disponibility, $surveyID) {
		
		$this->id            = $id;
		$this->timeSlot      = $timeSlot;
		$this->user          = $user;
		$this->disponobility = $disponibility;
		$this->survey_id     = $surveyID;
	}

  /**
   * Retourne l'identifiant d'une réponse à un sondage
	*@return int (un nombre)
   */
	public function getId(){
		return $this->id;
	}

  /**
	* Récpère l'ID du sondage où se trouve la réponse.
   */
	public function getSurveyID(){
		return $this->survey_id;
	}
	 
  /**
   * Récupère le créneau horraire chosi par l'utilisateur.
   * @return string exemple: 2014-12-10 16:15:00
   */
	public function getTimeSlot(){
		return $this->timeSlot;
	}

  /**
	* Retoune le nom du "propriaitaire" de la réponse
   * @return string $this->user
   */
	public function getUser(){
		return $this->user;
	}
   
  /**
   * Retourne la disponibilité de la personne en fonction du sondage et du créneau horraire.
	* @return string "OK" si est disponible sinon "NO", si il n'est pas disponible
   */
	public function getDisponibility(){
		return $this->disponobility;
	}
	

}
?>
