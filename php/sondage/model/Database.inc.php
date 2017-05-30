
<?

require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");
require_once("model/Comment.inc.php");

class Database {

	private $connection;

	/**
	 * Ouvre la base de données. Si la base n'existe pas elle
	 * est créée à l'aide de la méthode createDataBase().
	 */
	public function __construct() {
		
		$dbHost = $_SERVER['dbHost'];
		$dbBd = $_SERVER['dbBd'];
		$dbPass = $_SERVER['dbPass'];
		$dbLogin = $_SERVER['dbLogin'];

		$url = 'mysql:host='.$dbHost.';dbname='.$dbBd;
		$this-> connection = new PDO($url, $dbLogin, $dbPass);
		if (!$this->connection) die("impossible d'ouvrir la base de données");
		$this->createDataBase();
	}


	/**
	 * Initialise la base de données ouverte dans la variable $connection.
	 * Cette méthode crée, si elles n'existent pas, les trois tables :
	 * - une table users(nickname char(20), password char(50));
	 * - une table surveys(id integer primary key autoincrement,
	 *						owner char(20), question char(255));
	 * - une table responses(id integer primary key autoincrement,
	 *		id_survey integer,
	 *		title char(255),
	 *		count integer);
	 */
	private function createDataBase() {

	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS users ("." nickname char(20),"." password char(50)".");");
	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS surveys("."ID int PRIMARY KEY AUTO_INCREMENT,"."owner char(20)".", 
										"."question char(255)".");");
	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS responses("."ID Integer PRIMARY KEY AUTO_INCREMENT,"."id_survey Integer".", 
										"."title char(255)".", "." count Integer );");

	$this->connection -> exec("CREATE TABLE IF NOT EXISTS comments("."ID Integer PRIMARY KEY AUTO_INCREMENT,"."id_survey Integer".", 
										"."message varchar(1000)".", "." owner char(20)".",date char(50));");

	}


	/**
	 * Vérifie si un pseudonyme est valide, c'est-à-dire,
	 * s'il contient entre 3 et 10 caractères et uniquement des lettres.
	 *
	 * @param string $nickname Pseudonyme à vérifier.
	 * @return boolean True si le pseudonyme est valide, false sinon.
	 */
	private function checkNicknameValidity($nickname) {

		$lenght = strlen($nickname);
	
		if($lenght < 4 || $lenght > 10 ){
         return false;
		}

		for($i = 0; $i < 	$lenght ; $i++){
			if(is_numeric($nickname[$i])){
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
	 * Vérifie la disponibilité d'un pseudonyme.
	 *
	 * @param string $nickname Pseudonyme à vérifier.
	 * @return boolean True si le pseudonyme est disponible, false sinon.
	 */
	private function checkNicknameAvailability($nickname) {
		
			//$res = $this->connection->query("select * from users where nickname=\"$nickname\";");
			
			
			$query = $this->connection->prepare("select * from users where nickname = ? ");
			$query->execute(array($nickname));
					
			while ($ligne = $query->fetch() ) {
                if(strtolower( $ligne['nickname'])== strtolower($nickname))
						 return false;
			}
		return true;
	}

	/**
	 * Vérifie qu'un couple (pseudonyme, mot de passe) est correct.
	 *
	 * @param string $nickname Pseudonyme.
	 * @param string $password Mot de passe.
	 * @return boolean True si le couple est correct, false sinon.
	 */
	public function checkPassword($nickname, $password) {

   		    $query = $this->connection->prepare("select * from users where nickname = ? ");
			$query->execute(array($nickname));
   		
			while ($ligne = $query->fetch() ) {
                if($ligne['password']== md5($password))
						 return true;
			}

		return false;
	}

	/**
	 * Ajoute un nouveau compte utilisateur si le pseudonyme est valide et disponible et
	 * si le mot de passe est valide. La méthode peut retourner un des messages d'erreur qui suivent :
	 * - "Le pseudo doit contenir entre 3 et 10 lettres.";
	 * - "Le mot de passe doit contenir entre 3 et 10 caractères.";
	 * - "Le pseudo existe déjà.".
	 *
	 * @param string $nickname Pseudonyme.
	 * @param string $password Mot de passe.
	 * @return boolean|string True si le couple a été ajouté avec succès, un message d'erreur sinon.
	 */

	public function addUser($nickname, $password) {
	 
		
		if( ! $this->checkNicknameAvailability($nickname)){
		   $string = "Le pseudo existe déjà.";
			return $string;
		}

		if( ! $this->checkNicknameValidity($nickname)){
			$string = "Le pseudo doit contenir entre 3 et 10 lettres.";
			return $string;
		}

		if( ! $this->checkPasswordValidity($password)){
			$string = "Le mot de passe doit contenir entre 3 et 10 caractères.";
			return $string;
		}

		$sql = "INSERT INTO users(nickname,password) VALUES (:nickname,:password)";
   		$q   =  $this->connection ->prepare($sql);
   		$q->execute(array(':nickname'=>$nickname , ':password'=> md5($password) ));

	  	return "true";
	}

	/**
	 * Change le mot de passe d'un utilisateur.
	 * La fonction vérifie si le mot de passe est valide. S'il ne l'est pas,
	 * la fonction retourne le texte 'Le mot de passe doit contenir entre 3 et 10 caractères.'.
	 * Sinon, le mot de passe est modifié en base de données et la fonction retourne true.
	 *
	 * @param string $nickname Pseudonyme de l'utilisateur.
	 * @param string $password Nouveau mot de passe.
	 * @return boolean|string True si le mot de passe a été modifié, un message d'erreur sinon.
	 */
	public function updateUser($nickname, $password) {
		/* TODO START */
	   /* TODO END */
		
		$password = md5($password);
		$query = $this->connection->prepare("UPDATE users SET password =? where nickname=?");
		$query->execute(array($password,$nickname));
		
		if(! $query){
			return false; 
		}
		
	  	return true;
	}

	/**
	 * Sauvegarde un sondage dans la base de donnée et met à jour les indentifiants
	 * du sondage et des réponses.
	 *
	 * @param Survey $survey Sondage à sauvegarder.
	 * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
	 */
	 
	
	public function saveSurvey($survey) {
		/* TODO START */
	
		$this->connection->beginTransaction();
		 
  		$query = $this->connection->prepare("INSERT INTO surveys(owner,question)"."VALUES (?,?)");
  
  		if ($query===false){ 
			$this->connection->rollback(); 
			return false; 
		}
		
		$r = $query->execute(array($survey->getOwner(), $survey->getQuestion()));
		
		if ($r === false){ 
			$this->connection->rollback(); 
			 return false; 
		}

		$id = $this->connection->lastInsertId();
		$survey->setId($id);
		$responses = &$survey->getResponses();

		foreach ($responses as &$response) {
			if ($this->saveResponse($response)===false) {
			$this->connection->rollback(); 
			return false;
			}
		}

		$this->connection->commit(); return true;

		
	}


	public function deleteSurvey($id_survey){


    $deleteSurveys = $this->connection->prepare("Delete FROM surveys where ID=?");
	$deleteSurveys->execute(array($id_survey));
    if(! $deleteSurveys ) return false;
    

	$deleteComments = $this->connection->prepare("Delete FROM comments where id_survey=?");
	$deleteComments->execute(array($id_survey));
	if(! $deleteComments) return false;
	
	$deleteResponses = $this->connection->prepare("Delete FROM responses where id_survey=?");
	$deleteResponses->execute(array($id_survey));
    if(!$deleteResponses) return false;

	return true;	
	
	}

	/**
	 * Sauvegarde une réponse dans la base de donnée et met à jour son indentifiant.
	 *
	 * @param Response $response Réponse à sauvegarder.
	 * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
	 */
	private function saveResponse($response) {
		/* TODO START */
		/* TODO END */
		
   	    $query = $this->connection->prepare("INSERT INTO responses(id_survey,title,count)". "VALUES (?,?,?)");

	
		$id_survey = $response->getSurvey()->getId();
		$title     = $response->getTitle();
		$count     = $response->getCount();
	
   		$query->execute(array($id_survey ,$title , $count ));
   		if(!$query)  return false;

		return true;
	
	}


	/**
	 * Charge l'ensemble des sondages créés par un utilisateur.
	 *
	 * @param string $owner Pseudonyme de l'utilisateur.
	 * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
	 */
	public function loadSurveysByOwner($owner) {
		
		/* TODO START */
		/* TODO END */

		$query = $this->connection->prepare("select * from surveys where owner = ?");
	    $query->execute(array($owner));
		
		if(!$query) return false;
		
		$arraySurveys = 	$query->fetchAll();
		$surveys 	  = 	$this->loadSurveys($arraySurveys);


		for($i=0; $i < count($surveys); $i++){

			$id					= 	$surveys[$i]->getId();
			$queryLoadResponses = $this->connection->prepare("select * from responses WHERE id_survey = ?");
	        $queryLoadResponses->execute(array($id));
	        
			if(!$queryLoadResponses) return false;
			$arrayResponses 	= 	$queryLoadResponses->fetchAll();
		   	$Responses 			= 	$this->loadResponses($surveys[$i], $arrayResponses);

		   for($j = 0; $j < count($Responses); $j++){
				$surveys[$i]->addResponse($Responses[$j]);
			}
		}


		for($i=0; $i < count($surveys); $i++){

			$id  			  = $surveys[$i]->getId();
		    $queryLoadComment = $this->connection->prepare("select * from comments WHERE id_survey = ?");
	        $queryLoadComment->execute(array($id));
		   	
		   	
		   	if(!$queryLoadComment) return false;
			$arrayComments 	  = $queryLoadComment ->fetchAll();
			$comments 		  = $this->loadComments($surveys[$i], $arrayComments);

        	for($j = 0; $j < count($comments); $j++){
				$surveys[$i]->addComment($comments[$j]);
		 	}
	  	}

     	return $surveys;

 }


	/**
	 * Charge l'ensemble des sondages dont la question contient un mot clé.
	 *
	 * @param string $keyword Mot clé à chercher.
	 * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
	 */
	public function loadSurveysByKeyword($keyword) {
		
	    $query = $this->connection->prepare("select * from surveys where question like ?");
	    $query->execute(array("%$keyword%"));
	    
	    if(!$query) return false;
		$arraySurveys = $query->fetchAll();
		$surveys = $this->loadSurveys($arraySurveys);


		for($i=0; $i < count($surveys); $i++){

		   $id                 =  $surveys[$i]->getId();
		   $queryLoadResponses = $this->connection->prepare("select * from responses where id_survey = ?");
	       $queryLoadResponses->execute(array($id));
		   
		   if(!$queryLoadResponses) return false;
		   $arrayResponses     =  $queryLoadResponses->fetchAll();
		   $Responses          =  $this->loadResponses($surveys[$i], $arrayResponses);

         for($j = 0; $j < count($Responses); $j++){
				$surveys[$i]->addResponse($Responses[$j]);
			}
		 }

		for($i=0; $i < count($surveys); $i++){

		   $id  			 = 	$surveys[$i]->getId();
		   $queryLoadComment = $this->connection->prepare("select * from comments where id_survey = ?");
	       $queryLoadComment->execute(array($id));
		   
		   if(!$queryLoadComment) return false;
		   $arrayComments 	 = 	$queryLoadComment ->fetchAll();
		   $comments 		 = 	$this->loadComments($surveys[$i], $arrayComments);

           for($j = 0; $j < count($comments); $j++){
				$surveys[$i]->addComment($comments[$j]);
			}

		 }

     return $surveys;
 }


	/**
	 * Enregistre le vote d'un utilisateur pour la réponse d'identifiant $id.
	 *
	 * @param int $id Identifiant de la réponse.
	 * @return boolean True si le vote a été enregistré, false sinon.
	 */
	public function vote($id) {
		
		/* TODO START */
		/* TODO END */

		$query = $this->connection->prepare("UPDATE responses SET count= count+1 where ID= ?");
	    $query->execute(array($id));
		
		if(!$query) return false;
		
		return true;
		
	}

	/**
	 * Construit un tableau de sondages à partir d'un tableau de ligne de la table 'surveys'.
	 * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
	 *
	 * @param array $arraySurveys Tableau de lignes.
	 * @return array(Survey)|boolean Le tableau de sondages ou false si une erreur s'est produite.
	 */

	private function loadSurveys($arraySurveys) {
		$surveys = array();
		
		foreach($arraySurveys as $row){
			$survey = new Survey($row['owner'], $row['question']);
			$survey->setId($row['ID']);
			$surveys[] = $survey;
	  }

		return $surveys;
  }

	/**
	 * Construit un tableau de réponses à partir d'un tableau de ligne de la table 'responses'.
	 * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
	 *
	 * @param Survey $survey Le sondage.
	 * @param array $arraySurveys Tableau de lignes.
	 * @return array(Response)|boolean Le tableau de réponses ou false si une erreur s'est produite.
	 */
	private function loadResponses($survey, $arrayResponses) {
		
		$responses = array();
		
		/* TODO START */
		/* TODO END */
			
		for($i=0; $i < count($arrayResponses) ; $i++ ){	
				$response = new Response($survey,$arrayResponses[$i]['title'], $arrayResponses[$i]['count']);
				$response->setId($arrayResponses[$i]['ID']);
				$responses[] = $response;
			}

		return $responses;
	}


	public function saveComment($comment){

		$query = $this->connection->prepare("INSERT INTO comments(ID, id_survey , message, owner, date) ". "VALUES (?,?,?,?,?)");
		$id 	 = $this->connection->lastInsertId();
		$comment->setId($id);

		$ID        = $comment->getId();
		$id_survey = $comment->getSurveyId();
		$message   = $comment->getMessage();
		$owner 	  = $comment->getOwner();
		$heure 	  = date("H:i");
		$date  	  = date("d-m-Y");
		$date  	  = "le $date à $heure";
	
     	$query->execute(array($ID ,$id_survey, $message, $owner, $date ));
     	if(!$query)  return false;
     	
     	
     	return true;
	}


	public function loadComments($survey, $arrayComments){

		/* TODO START */
		/* TODO END */
		
		$comments = array();

		for($i=0; $i < count($arrayComments) ; $i++ ){	
			 $comment = new Comment($arrayComments[$i]['id_survey'],$arrayComments[$i]['message'],$arrayComments[$i]['owner']);
			 $comment->setId($arrayComments[$i]['ID']);
			 $comment->setDate($arrayComments[$i]['date']);
			 $comments[] = $comment;
		}
		
		return $comments;
	}

}

?>
