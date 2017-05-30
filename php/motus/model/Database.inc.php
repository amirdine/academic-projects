
<?

require_once("model/Motus.inc.php");
require_once("model/Scores.inc.php");
require_once("model/Proposal.inc.php");

class Database {

	private $connection;

	/**
	 * Ouvre la base de données. Si la base n'existe pas elle
	 * est créée à l'aide de la méthode createDataBase().
	 */
	public function __construct() {
			
		$dbHost  = $_SERVER['dbHost'];
		$dbBd    = $_SERVER['dbBd'];
		$dbPass  = $_SERVER['dbPass'];
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

	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS player ("." nickname char(20),"." password char(50)".");");
	  
	 $this->connection -> exec("CREATE TABLE IF NOT EXISTS scores("." pseudo char(20),"." played_games int(5) ,"." won_games int(5), "." average_time char(20) ".");");

	  $this->connection -> exec("CREATE TABLE IF NOT EXISTS secret("." ID int PRIMARY KEY AUTO_INCREMENT,"." secret_word  char(8) );");
	 
	 
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
			
			
			$query = $this->connection->prepare("select * from player where nickname = ? ");
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

   		    $query = $this->connection->prepare("select * from player where nickname = ? ");
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

		$sql = "INSERT INTO player(nickname,password) VALUES (:nickname,:password)";
   		$q   =  $this->connection ->prepare($sql);
   		$query = $q->execute(array(':nickname'=>$nickname , ':password'=> md5($password) ));
			

			if (!$query) {
   			echo "\nPDO::errorInfo():\n";
  			 print_r( $this->connection->errorInfo());
			}

	  	return true;
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
	



    function make_seed(){
         list($usec, $sec) = explode(' ', microtime());
         return (float) $sec + ((float) $usec * 100000);
    }
	
	public function reset(){

			$vider = "TRUNCATE secret";
   		    $query  = $this->connection ->prepare($vider);
			   $query->execute();
			
			 $v = "TRUNCATE motus";
   		 $q  = $this->connection ->prepare($v);
			 $q->execute();
			
	  	 $values = explode("\n",file_get_contents("mots.txt" ));
	  	
      srand($this->make_seed());
		$secretword = strtolower ($values[rand( 1 , 1000)]);

		
		
		 $sql = "INSERT INTO secret(secret_word) VALUES (:secret_word)";
   		 $q   =  $this->connection ->prepare($sql);
   		 $q->execute(array(':secret_word'=>$secretword));
	    
	    return "true";
	    
	}
	
	public function getSecretWord(){
	
		
   		    $query = $this->connection->prepare("select * from secret");
			$query->execute();
   		
			while ($ligne = $query->fetch() ) {
                $word = $ligne['secret_word'];
						 return  $word;
			}	
	}
	
	
	

	public function createScores($score){

		$pseudo        = $score->getPseudo();
		$played_games  = $score->getPlayedGames();
		$won_game      = $score->getWonGames();
		$average_times = $score->getAverageTime();


		 $sql = "INSERT INTO scores(pseudo, played_games, won_games, average_time) VALUES (:pseudo, :played_games, :won_games, :average_time)";
   	 $q   =  $this->connection->prepare($sql);



    $requete =$q->execute(array(':pseudo'=>$pseudo, ':played_games'=>$played_games, ':won_games'=>$won_game, ':average_time'=>$average_times));

		if (! $requete) {
   			echo "\nPDO::errorInfo():\n";
   			print_r($this->connection->errorInfo());
		}
	    return "true";
			

	}

	public function loadScores(){

		 $scores = array();

		 $query = $this->connection->prepare("select * from scores");
		 $query->execute(array());

		 $arrayScores = $query->fetchAll();
				
		 return  $arrayScores ;
	}


	public function SessionGames($player){
		$query = $this->connection->query("UPDATE scores SET played_games=played_games+1 where pseudo=\"$player\";");
	    return "true";
	}

	 public function addPointWon($player, $time){

		 $query = $this->connection->query("UPDATE scores SET won_games=won_games+1 where pseudo=\"$player\";");
	     $scores = $this->connection->query("select * from scores where pseudo=\"$player\";");
	     
	     $scores = $scores->fetchAll();
         $won_game = $scores[0]["won_games"];
         
         $average_time  =  $scores[0]["average_time"];
         $average_time  =  $average_time + $time;
         $average_time  =  $average_time/$won_game;
        
         $this->connection->query("UPDATE scores SET average_time=\"$average_time\"  where pseudo=\"$player\";");
	}
}

?>
