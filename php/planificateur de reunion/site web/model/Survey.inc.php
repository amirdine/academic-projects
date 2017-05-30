<?


class Survey {

  /**
   * @class  La classe Survey représente l'objet Sondage
   */
	
	private $id;
	private $title;
	private $responses ;
   private $timeSlotList;
	private $author;
	private $comment;
	private $disponibilityNumbersByTimeSlot;
	private $maxNumberAvailablePerson;
	
	
	public function __construct() {
	
	  $this-> id          = mt_rand (10000, 99999);
	  $this->response     = null;
	  $this->timeSlotList = array();
	}

  /**
	* Retourne l'ID du sondage
	* @string exemple 147841
   */
	public function getID(){
     return $this->id;
	}

  /**
   * Fixe le nom du celui qui crée du songage.
	* @param string $author
   */
	public function setAuthour($author){
		$this->author = $author;
	}

  /**
	* récupèrer le nom de l'auteur du sondage.
	* @return string
	*/
	public function getAuthor(){
		return $this->author;
	}

  /**
   * Fixe l' id du sondage, récupèraration via la base de donnée.
	* @param string $surveyID
   */
	public function setID($surveyID){
		$this->id = $surveyID ;
	}	

  /**
   * Permet d'ajouter dans le sondage les créneaux horaire (celui proposé par l'auteur du sondage).
	* @param TimeSlot $timeSlot
   */
	public function addTimeSlot($timeSlot){
		$this->timeSlotList[] = $timeSlot;		
	}

  /**
   * Permet d'ajouter dans le sondage les réponses choisi par des utilisateurs.
	* @param array of Response $response
   */
	public function addResponses($response){
		$this->responses = $response;		
	}

  /**
   * Retourne dans le sondage les réponses choisi par des utilisateurs.
	* @return array of Response
   */
	public function getResponses(){
		return $this->responses;
	}

 /**
   * Retourne un tableau de créneaux horaire.
	* @return array of TimeSlot
   */
   public function getTimeSlots(){
		return $this->timeSlotList;
	}

  /**
   * Retourne le nombre de créneaux horaire dans un sondage.
	* @return nombre
   */
	public function getTimeSlotsNumber(){
			return count($this->timeSlotList);
	}

  /**
   * Retourne un commenraire au sujet du sondage en question. 
	* @return string
   */
	public function getComment(){
		return $this->comment;
	}
	
  /**
   * Fixe un commenraire au sujet du sondage en question. 
	* @param string $comment
   */
	public function setComment($comment){
		$this->comment = $comment;
	}

  /**
   * Fixe un titre au sondage en question. 
	* @param string $title
   */
	public function setTitle($title){
		$this->title = $title; 
	}

  /**
   * Retourne le titre du sondage en question. 
	* @return string 
   */
	public function getTitle(){
		return $this->title;
	}

  /**
   * Retourne le nombre de personne disponible pour chaque créneau horaire. 
	* @return array of int
   */
	public function getDisponibilityNumbersByTimeSlot(){
		return $this->disponibilityNumbersByTimeSlot;
	}

  /**
   * Fixe le nombre de personne disponible pour chaque créneau horaire. 
	* @param array $array
   */
	public function setDisponibilityNumbesByTimeSlot($array){
		$this->disponibilityNumbersByTimeSlot = $array;	
	}

  /**
	* Retourne le nombre de personne disponible du meilleur créneau horaire.
   * @return nombre
   */
	public function getMaxNumberAvailablePersons(){
		return $this->maxNumberAvailablePerson;
	}

  /**
	* Fixe le nombre de personne disponible du meilleur créneau horaire.
   * @param nombre
   */
   public function setMaxNumberAvailablePersons($number){
		$this->maxNumberAvailablePerson	= $number;
  }

}
?>
