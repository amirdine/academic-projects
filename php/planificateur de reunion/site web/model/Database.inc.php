
<?
require_once("model/TimeSlot.inc.php");
require_once("model/Response.inc.php");

class Database {

	private $connection;
	private $salt;

	/**
	 * Ouvre la base de données. Si la base n'existe pas elle
	 * est créée à l'aide de la méthode createDataBase().
	 */
	public function __construct() {
		
		$dbHost  = $_SERVER['dbHost'];
		$dbBd    = $_SERVER['dbBd'];
		$dbPass  = $_SERVER['dbPass'];
		$dbLogin = $_SERVER['dbLogin'];

		$this->salt = 	$dbPass;

		$url = 'mysql:host='.$dbHost.';dbname='.$dbBd;
		$this-> connection = new PDO($url, $dbLogin, $dbPass);
		if (!$this->connection) die("impossible d'ouvrir la base de données");
		$this->createDataBase();
	}



	private function createDataBase() {

	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS accounts("." login char(20) PRIMARY KEY,"." 
										password char(50)".")ENGINE=INNODB;");
	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS surveys("."survey_id int PRIMARY KEY ,"."title char(20),"."comment varchar(100)," 
                              ." author char(25), FOREIGN KEY(author) REFERENCES accounts(login))ENGINE=INNODB;");
	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS timeslots("."timeslot_id  int PRIMARY KEY ," ." survey_id int," 
                             ."debut DATETIME,".""."fin DATETIME, FOREIGN KEY(survey_id) REFERENCES surveys(survey_id)".")ENGINE=INNODB;");
	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS responses("."response_id  int PRIMARY KEY ," ." user char(25)," 
                             ."disponibilty char(10),".""."timeslot_id int, 
										FOREIGN KEY(timeslot_id) REFERENCES timeslots(timeslot_id) ".")ENGINE=INNODB;");
	}


  /** 
   * Verifie  si le login est valide.
	* C'est à dire qu'il contient entre 4 et 10 caractères
   * 
   * @param string $login
	* @return boolean True si le login est valide, false sinon
	*/
	private function checkNicknameValidity($login) {

		$lenght = strlen($login);
	
		if($lenght < 4 || $lenght > 10 ){
         return false;
		}

		for($i = 0; $i < 	$lenght ; $i++){
			if(is_numeric($login[$i])){
				return false;
			}
		}
   	return true;
	}


	/**
	 * Vérifie si un mot de passe est valide, c'est-à-dire,
	 * s'il contient entre 3 et 10 caractères.
	 *
	 * @param string $password Mot de passe à vérifier.
	 * @return boolean True si le mot de passe est valide, false sinon.
	 */
	private function checkPasswordValidity($password) {
		
		$lenght = strlen($password);

		if($lenght < 4 || $lenght > 10 ){
         return false;
		}
		
		return true;
	}


  /** 
	* Test la disponibilité d'un login.
   * C'est à dire, vérifie si login n'a pas déjà été pris
	* 
	*@param   string $login
   *@return boolean True si le login est disponbile, sinon false.
   */
	private function checkNicknameAvailability($login) {
		
			$query = $this->connection->prepare("SELECT * FROM accounts WHERE login= ?;");
		   $query->execute(array($login));
			
			while ($ligne = $query->fetch() ) {
                if($ligne['login']== $login)
						 return false;
			}
	    	return true;
	}


	/**
	 * Vérfie si le mot de passe saisi par l'utilisateur est correct.
	 * 
    * @param string $login
	 * @param string $password
    *
    * @return boolean True si le mot de passe est correct, sinon false
    */
	 public function checkPassword($login, $password) {

		$query = $this->connection->prepare("SELECT * FROM accounts WHERE login= ?;");
		$query->execute(array($login));
		
		while ($ligne = $query->fetch() ) {
					 $password = $password.$this->salt;
                if($ligne['password']== md5($password))
						 return true;
		}
		return false;
	}

	
  /**
   * Permet d'ajouter un utilisateur lors de l'inscription.
   * 
   * @param string $login 
	* @param string $password 
   *
   * return string [un message d'erreur], sinon string "True".
   */
	public function addUser($login, $password) {
	 
		
		if( ! $this->checkNicknameAvailability($login)){
		   $string = "Le pseudo existe déjà.";
			return $string;
		}

		if( ! $this->checkNicknameValidity($login)){
			$string = "Le pseudo doit contenir entre 3 et 10 lettres.";
			return $string;
		}

		if( ! $this->checkPasswordValidity($password)){
			$string = "Le mot de passe doit contenir entre 3 et 10 caractères.";
			return $string;
		}

		$password = $password.$this->salt;
		$sql = "INSERT INTO accounts(login,password) VALUES (?,?)";
   	$q   =  $this->connection ->prepare($sql);
   	$q->execute(array($login , md5($password)));

	  	return "true";
	}

	
  /**
   * Permet de changer de mot de passe.
   * @param string $login.
	* @param string $password
	*
   * @return True si la changement de mot de passe s'est effectué correctement.
   */
	public function updateUser($login, $password) {
		
		/* A FAIRE */
	  return true;
	}


  /** 
   * Permet d'inserer une nouveau sondage dans la  base de données 
   * lorsqu'un utilisateur crée un sondage.
   *
   * @param string $surveyID, ID du sondage
   * @param string $title   , Titre du sondage.
   * @param string $comment , information concernant la réunion
   * @param string $author  , L'auteur du sondage.
   *
	* @return boolean, si le création du sondage s'est bien passé 
	*/
	public function insertSurvey($surveyID, $title, $comment, $author) {
   	$query = $this->connection->prepare("INSERT INTO surveys(survey_id,title,comment,author)". "VALUES (?,?,?,?)");
   	$query->execute(array($surveyID, $title,$comment, $author));

		return true;	
	}


  /** 
	* Pour un sondage, on insère un créneau horaire,
	* Sous cette forme, exemple: $debut = 2014-12-10 14:15:00 - $fin = 2014-12-10 16:15:00
	*
   * @param TimeSlot $timeSlot
	* @param string   $surveyID
	*
	* @return boolean true, si l'ajout d'un créneau horaire. s'est bien passé.
	*/
  	public function insertTimeSlot($timeSlot, $SurveyID) {
			
   	$query = $this->connection->prepare("INSERT INTO timeslots(timeslot_id,survey_id,debut,fin)". "VALUES (?,?,?,?)");

		$id        = $timeSlot->getID();
		$debut     = $timeSlot->getFullStartTime();
		$fin       = $timeSlot->getFullEndTime();

   	$query->execute(array($id,$SurveyID,$debut, $fin));

		return true;		
	}


  /** 
   * On calcule le nombre de personne disponible pour chaque créneau horaire..
   *
	* @param string $surveyID
	* @return array,retourne un tableau de nombre. 
	*/
	public function getDisponibilityNumbersByTimeSlot($surveyID){
		
			$query = $this->connection->prepare("SELECT DISTINCT responses.timeslot_id ,  COUNT(*)  disponibility_number  
														    FROM responses, timeslots  
													       WHERE timeslots.timeslot_id=responses.timeslot_id 
														    AND  disponibilty=\"OK\" AND survey_id=?
														    GROUP BY responses.timeslot_id 
														    ORDER BY debut;");

			$query->execute(array($surveyID));

			$disponibility_number  = array();
				
			while ($ligne = $query->fetch() ) {
						$disponibility_number[] = $ligne['disponibility_number'];	
			}

			return $disponibility_number;	
	}



	/** 
	 * Cherche dans chaque créneau horaire d'un sondage,
	 * le nombre maximal de personne disponible dans un créneau horaire..
	 * Utile pour savoir le meilleur créneau horaire.
    *	
	 * @param string $surveyID
	 * @return un nombre	
	 */
	 public function getMaxNumberAvailablePersons($surveyID){
		
			$query = $this->connection->prepare("SELECT DISTINCT responses.timeslot_id ,  COUNT(*)  disponibility_number  
														    FROM responses, timeslots  
													       WHERE timeslots.timeslot_id=responses.timeslot_id 
														    AND  disponibilty=\"OK\" AND survey_id=? 
														    GROUP BY responses.timeslot_id 
														    ORDER BY  disponibility_number DESC LIMIT 1;");

			   $query->execute(array($surveyID));

				$maxNumberAvailablePersons  = array();
				
				while ($ligne = $query->fetch() ) {
					return $ligne['disponibility_number'];	
				}
	  }


   /**
	 * Récupère tous les informations d'un sondage.
	 * 
    * @param string surveyID
	 * @return Survey
	 */
	 public function getSurvey($surveyID){

		   $query = $this->connection->prepare("SELECT *  FROM timeslots, surveys WHERE timeslots.survey_id = surveys.survey_id  
                                          AND surveys.survey_id=? order by debut;");

			$query->execute(array($surveyID));
			$survey = new Survey();

			while ($ligne = $query->fetch() ) {
                
				$surveyID   = $ligne['survey_id'];
				$title      = $ligne['title']; 
				$author 		= $ligne['author'];
				$timeSlotID = $ligne['timeslot_id'];	
				$startTime  = $ligne['debut'];
				$endTime    = $ligne['fin'];

				$comment 	= $ligne['comment'];

				$survey->SetID($surveyID);
				$survey->setTitle($title);
				$survey->SetAuthour($author);
				$survey->SetComment($comment);

				$timeSlot = new TimeSlot( new DateTime($startTime),  new DateTime($endTime));
				$timeSlot->setID($timeSlotID);
			 	$survey->addTimeSlot($timeSlot);		
  		}

		$array  = $this->getDisponibilityNumbersByTimeSlot($surveyID);
      $number = $this->getMaxNumberAvailablePersons($surveyID);
		
		$survey->setDisponibilityNumbesByTimeSlot($array);
		$survey->setMaxNumberAvailablePersons($number);
      
		return $survey;
	}

  /**
   * Recupère les créneaux horaire.s d'un sondage spécifique.
   *
   * @param string $surveyID
	* @return $timeSlot
   */
	private function getTimeSlotsIDBySurveyID($surveyID){

		$query = $this->connection->prepare("SELECT timeslot_id FROM timeslots WHERE survey_id=?;");
      $query->execute(array($surveyID));
		
		$timeSlots = array();

		while ($ligne = $query->fetch()) {
			$timeSlots[] = $ligne['timeslot_id'];	
		}
	
		return $timeSlots;
	}


  /** 
	* Empêche de faire plus de 1 sondage avec le meme nom. 
	* Utile pour éviter les doublons dans le résultat d'un sondage.
	* 
	* @param string $name
   * @param string $timeSlotID
	*
	* @return False si la personne a déjà répondu au sondage, sinon True
	* @see public function insertResponse() dans le fichier Database.inc.php
	*/
	public function checkDuplicateResponse($name, $timeSlotID){
		
		$query = $this->connection->prepare("SELECT * FROM responses WHERE user= ? AND timeslot_id= ?;");
		$query->execute(array($name, $timeSlotID));
		
		while ($ligne = $query->fetch() ){
			return false;
		}
		return true;
	}


  /**
   * Insérer les réponses d'un utilisateur dans un sondage 
	*
	* @param  array  $responses
   * @param  string $surveyID
	* @param  string $name
	* @return boolean True, si l'insertion s'est bien passé.
	*/
	public function insertResponse($responses, $surveyID, $name){
          	    
			$timeSlots = $this->getTimeSlotsIDBySurveyID($surveyID);
		
			foreach($timeSlots as $value){
			 $id = mt_rAND (10000, 99999);
			
			 if($this->checkDuplicateResponse($name, $value)){
			 	$query = $this->connection->prepare("INSERT INTO responses(response_id,user,disponibilty,timeslot_id)". "VALUES (?,?,?,?)");
          	$res = $query->execute(array($id,$name,"NO", $value));	
			   }
          }   
    
			foreach($responses as $value){			
		   	$query = $this->connection->prepare("UPDATE responses SET disponibilty = ? WHERE timeslot_id = ? AND user = ?");
         	$res   = $query->execute(array("OK", $value, $name));	
			}
			return true;
	}

   /**
	 * Retourne un tableau contenant les noms de personnes qui ont répondu au sondage.
    *
	 * @param  string $surveyID
	 * @return array 
    */
  	 private function getUserName($surveyID){

		$query = $this->connection->prepare("SELECT DISTINCT timeslots.survey_id, user FROM responses, timeslots  
													  WHERE survey_id= ?  ORDER  BY user;");

		$query->execute(array($surveyID));	
		
      $tab;
	   $indice = 0;

		while ($ligne = $query->fetch() ){
				$name         = $ligne['user'];
				$tab[$indice] = $name;
				$indice++;			
			}
			return $tab;
	}
		

		private function getIndexName($tab, $name){

			$index = 0;

			foreach($tab as $value){
				if($value == $name){
				  return $index;
				}
			  	$index++;
			}
		}


	  /** 
		* Permet de récupérer les réponses d'un sondage 
      *
      *@param  string $surveyID
      *@return array , retourne un tableau de réponses d'un sondage.
      */
		public function getResponse($surveyID){

			$query = $this->connection->prepare("SELECT response_id, timeslots.timeslot_id, survey_id, debut, fin, user, disponibilty 
														   FROM  timeslots, responses 
														    WHERE timeslots.timeslot_id = responses.timeslot_id
														    AND survey_id= ? order by debut;");

			$query->execute(array($surveyID));

			$tab   = $this->getUserName($surveyID);
         
         $i = 0;
			while ($ligne = $query->fetch() ){
				
				 $responseID      = $ligne['response_id'];
				 $timeSlotID      = $ligne['timeslot_id'];
				 $surveyID        = $ligne['survey_id'];
				 $userID          = $ligne['user'];
				 $disponibility   = $ligne['disponibilty'];
				 $startTime       = $ligne['debut'];
				 $endTime         = $ligne['fin'];

				 $timeSlot = new TimeSlot( new DateTime($startTime),  new DateTime($endTime));
				 $timeSlot->setID($timeSlotID);

				 $response = new Response($responseID, $timeSlot, $userID, $disponibility, $surveyID);
				 $index    = $this->getIndexName($tab, $userID);
	
				 $t[$index][$i] = $response;

				$i++;
			}
			 return $t;
		}
	

     /**
      * Permet de vérifier si un sondage n'existe pas.
      *
      * @param string $survey
      * @return boolean True si le sondage n'existe pas, sinon false.
      */
		public function surveyNotExist($surveyID){

			$query = $this->connection->prepare("SELECT * FROM surveys WHERE survey_id= ?;");
			$query->execute(array($surveyID));

			while ($ligne = $query->fetch() ){
				return false;
			}
			return true;
		}

     /**
		* Permet de récupérer tous les sondages créé par par utilisateur.
		*
		* @param  string $author.
		* @return array  $surveyID, tableau contenant les n° ID des sondage de l'utilisateur.
      */
		public function getSurveysIDByAuthor($author){
	
			
			$query = $this->connection->prepare("SELECT * FROM surveys WHERE author= ?;");
			$query->execute(array($author));
	
			$i = 0;
			$surveyID = null;

			while ($ligne = $query->fetch() ){
				 $surveyID[$i][0] = $ligne['survey_id'];
				 $surveyID[$i][1] = $ligne['title'];
					
				$i++;
			}
		   return $surveyID; 
		}
   }

?>
