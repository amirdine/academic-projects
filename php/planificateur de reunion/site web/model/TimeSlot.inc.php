<?


class TimeSlot {

	/**
    * @class  La classe TimeSlot représente un créneau horaire
    */
	
	private $timeSlotID;
   private $startTime;
	private $endTime ;
	private $monthArray;
	private $dayArray;

	public function __construct($startTime, $endTime) {
		
		$this->id        = mt_rand (10000, 99999);
		$this->startTime = $startTime;
		$this->endTime   = $endTime;

	$this->monthArray = array(
    '01'        => "Janvier",
    '02'        => "Février",
    '03'        => "Mars",
    '04'        => "Avril",
    '05' 		 => "Mai",
	 '06'        => "Juin",
	 '07'        => "Juillet",
	 '08'        => "Août",
	 '09'        => "Septembre",
	 '10'        => "Octobre",
	 '11'        => "Novembre",
	 '12'        => "Décembre");

	$this->dayArray = array(
    '0'        => "Dimanche",
    '1'        => "Lundi",
    '2'        => "Mardi",
    '3'        => "Mercredi",
    '4' 		   => "Jeudi",
	 '5'        => "Vendredi",
	 '6'        => "Samedi");
	}

  /**
   * Retourne l'ID du créneau horaire
   * @return nombre
   */
	public function getId(){
		return $this->id;
	}

  /**
   * Fixe l'ID du créneau horaire
   * @return nombre
   */
	public function setID($timeSlotID){
		$this->id = $timeSlotID;
	}

  /**
   * Retourne l'heure du début du créneau horaire
   * @return string ex: 14:15
   */
	public function getStartTime(){
		$string =  $this->startTime->format('H:i');
		return str_replace(":", "h", $string);
	}

  /**
   * Retourne la date et l'heure du début du créneau horaire
   * @return string ex: 2014-06-17 14:15
   */
	public function getFullStartTime(){
		return $this->startTime->format('Y-m-d H:i');	
	}

  /**
   * Retourne le mois du créneau horaire
   * @return string ex: Janvier
   */
   public function getMonth(){

		$monthNumber = $this->startTime->format( 'm' );
		$month       = $this->monthArray[$monthNumber];
		return $month;
	}

  /**
   * Retourne l'année du créneau horaire
   * @return string ex: 2014
   */
	public function getYear(){
				return $this->startTime->format( 'Y' );
	}

  /**
   * Retourne l'heure de fin du créneau horaire
   * @return string ex: 16:15
   */
	public function getEndTime(){
		$string =  $this->endTime->format('H:i');
		return str_replace(":", "h", $string);
	}

  /**
   * Retourne la date et l'heure du début du créneau horaire
   * @return string ex: 2014-06-17 14:15
   */
	public function getFullEndTime(){
		return $this->endTime->format('Y-m-d H:i');	
	}

  /**
   * Retourne la date (nombre) du créneau horaire
   * @return string ex: 14
   */
	public function getDayNumber(){
		return $this->endTime->format( 'd' );
	}

  /**
   * Retourne le jour  du créneau horaire
   * @return string ex: Jeudi
   */
	public function getWeekDay(){

		$timestamp = $this->startTime->format('Y-m-d');
		$dayNumber = date('w', strtotime($timestamp));
		
		return $this->dayArray[$dayNumber];
   }

  /**
   * Retourne la date du créneau horaire
   * @return string ex: 2014-05-14
   */
	public function getDate(){
		return $this->startTime->format('Y-m-d');
	}



}
?>
