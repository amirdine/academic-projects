<?

require_once("model/Member.inc.php");
require_once("model/MembersList.inc.php");
require_once("model/Book.inc.php");
require_once("model/BooksList.inc.php");



class Database {

		private $connection;

		public function __construct() {
		
       	
	  $dbHost = $_SERVER['dbHost'];
		$dbBd = $_SERVER['dbBd'];
		$dbPass = $_SERVER['dbPass'];
		$dbLogin = $_SERVER['dbLogin'];
 
		
   
	 	/* $dbHost  = 'localhost';
		$dbBd    = 'bibliotheque';
		$dbPass  = 'd8gfh';
		$dbLogin = 'root';
     */
     
		$url = 'mysql:host='.$dbHost.';dbname='.$dbBd;
		$this-> connection = new PDO($url, $dbLogin, $dbPass);
		if (!$this->connection) die("impossible d'ouvrir la base de données");

	}


	/* Affichage des erreurs SQL */

		private function MySqlError($query, $messageError){

			if(!$query){
				echo "$messageError :";
				print_r($this->connection->errorInfo());
				return false;
			}
	  }



   /* ****************************************  Vérifie si l'ID adhérent existe ***************************************** */

	public function checkMemberPassword($id_member){

		$command =   "SELECT NUMERO_ADHERENT FROM ADHERENT WHERE NUMERO_ADHERENT=?";
   	$query   =   $this->connection->prepare($command);
		$sql     =   $query->execute(array($id_member));
		
      $this->MySqlError($sql, "Erreur Mysql in function checkMemberPassword");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     			 return true;  
    	}
		
		return false;
	}



	 /* ****************************************  Ajoute un adhérent (inscription) ***************************************** */

	public function addMember($member){
				
			$command = "INSERT INTO ADHERENT(Numero_ADHERENT, NOM, PRENOM,DATE_NAISSANCE, VILLE, SEXE, 
                  	ADRESSE, COURRIEL, TELEPHONE, DATE_ADHESION, DD_PAIEMENT) 
							VALUES  (:Numero_ADHERENT,:NOM,:PRENOM,:DATE_NAISSANCE,:VILLE,:SEXE,
							         :ADRESSE, :COURRIEL,   :TELEPHONE, :DATE_ADHESION,:DD_PAIEMENT)";

		 	$query   =  $this->connection->prepare($command);
		 	$query   =  $query->execute(array( ':Numero_ADHERENT'=>$member->getId(), 
														  ':NOM'=>$member->getFamillyName(), 
														  ':PRENOM'=>$member->getFirstName(), 
											           ':DATE_NAISSANCE'=>$member->getDateOfBirth(), 
                                            ':VILLE'=>$member->getCity(), 
											           ':SEXE'  =>$member->getSex(), 
											           ':ADRESSE'=>$member->getAddress(),  
											           ':COURRIEL' =>$member->getEmail(), 
											           ':TELEPHONE'=>$member->getPhoneNumber(),
											           ':DATE_ADHESION'=>$member->getRegistrationDate(), 
											           ':DD_PAIEMENT'=>$member->getPayementDate() ));
						
			$this->MySqlError($query, "Erreur Mysql in function Member()");
	
			return true;	
   }



	 /* ****************************************  Detecte les membres identiques (inscription) *************************************** */
	
	public function CheckMember($famillyName, $firstName, $dateOfBirth){

		$query = $this->connection->prepare("SELECT NOM, PRENOM, DATE_NAISSANCE FROM ADHERENT WHERE NOM = ? AND PRENOM= ? AND DATE_NAISSANCE= ?");

		$query->execute(array($famillyName, $firstName, $dateOfBirth));
					
		if ($query->rowCount() != 0) {
 			return false;
		}	

		return true;
	}



	/* *********************************  Retourne les données d'un Livre à partir d'une liste  ********************************* */

	private function getBooks($bookSQLTable){

			$books = new BooksList();

		for($i=0; $i<count($bookSQLTable); $i++){
             
				$bookArray['isbn'] 						= 	$bookSQLTable[$i] ['ISBN'];
				$bookArray['disponibilite'] 			= 	$bookSQLTable[$i] ['DISPONIBILITE'];
				$purchaseDate								= 	$bookSQLTable[$i] ['DATE_ACHAT'];
				$bookArray['cote'] 						= 	$bookSQLTable[$i] ['COTE'];
				$code											= 	$bookSQLTable[$i] ['CODE_BARRE'];
				$bookArray['titre'] 						= 	$bookSQLTable[$i] ['TITRE'];
				$bookArray['date_parution'] 			= 	$bookSQLTable[$i] ['DATE_PARUTION'];
				$bookArray['nom_auteur'] 				= 	$bookSQLTable[$i] ['NOM_AUTEUR'];	
			   $bookArray['prenom_auteur'] 			= 	$bookSQLTable[$i] ['PRENOM_AUTEUR'];
				$bookArray['editeur'] 					= 	$bookSQLTable[$i] ['NOM_EDI'];
				$bookArray['numero_exemplaire'] 		= 	$bookSQLTable[$i] ['NUMERO_EXEMPLAIRE'];
				
          
				$book = new Book($bookArray);
				$book->setLibraryBookData($code, $purchaseDate);	
				$books->addBook($book);
			}
		
			
		   return $books;
	}

	/* *********************************  Retourne les données d'un adhérent à partir d'une liste  ********************************* */

	private function getMembers($adherentSQLTable){


			$civilStatus;
			
			$members = new MembersList();

			for($i=0; $i<count($adherentSQLTable); $i++){
             
            $civilStatus['nom'] 						   = 	$adherentSQLTable[$i] ['NOM'];
				$civilStatus['prenom'] 						= 	$adherentSQLTable[$i] ['PRENOM'];
				$civilStatus['date_de_naissance'] 		= 	$adherentSQLTable[$i] ['DATE_NAISSANCE'];
				$civilStatus['sexe'] 						= 	$adherentSQLTable[$i] ['SEXE'];
				$civilStatus['adresse'] 					= 	$adherentSQLTable[$i] ['ADRESSE'];
				$civilStatus['email'] 						= 	$adherentSQLTable[$i] ['COURRIEL'];
				$civilStatus['Telephone'] 					= 	$adherentSQLTable[$i] ['TELEPHONE'];
				$civilStatus['Villes'] 						= 	$adherentSQLTable[$i] ['VILLE'];
				
				$id 												= 	$adherentSQLTable[$i] ['Numero_ADHERENT'];
				$registrationDate								= 	$adherentSQLTable[$i] ['DATE_ADHESION'];
				$datePayement									=	$adherentSQLTable[$i] ['DD_PAIEMENT'];	

				$member = new Member($civilStatus);
				$member->setLibraryMemberData($id,$registrationDate,$datePayement);	
				$members->addMember($member);
			}

			return $members;

	}


	/* ******************************  Retourne une liste de livres en fonction d'un mot clé (Recherche) ***************************** */
		
	public function loadBookByKeyword($keyword){


		$query = $this->connection->prepare(" SELECT ISBN, DISPONIBILITE, DATE_ACHAT, LIVRE.COTE, CODE_BARRE, TITRE,  
														  DATE_FORMAT(DATE_PARUTION , '%d-%m-%Y') DATE_PARUTION , NOM_AUTEUR, 
														  PRENOM_AUTEUR, NOM_EDI, DATE_FORMAT(DATE_ACHAT , '%d-%m-%Y') DATE_ACHAT, NUMERO_EXEMPLAIRE  
														  FROM LIVRE, OEUVRE, AUTEUR, REDIGER,EDITEUR,CARACTERISE, MOT_CLE 
														  WHERE LIVRE.COTE = OEUVRE.COTE 
														  AND LIVRE.COTE = REDIGER.COTE  
														  AND AUTEUR.ID_AUTEUR = REDIGER.ID_AUTEUR  
														  AND LIVRE.ID_EDITEUR = EDITEUR.ID_EDITEUR 
														  AND CARACTERISE.NUM_MOTCLE=MOT_CLE.NUM_MOTCLE 
														  AND LIVRE.COTE=CARACTERISE.COTE 
														  AND MOT_CLES like ?");
	 
			$sql = $query->execute(array('%'.$keyword.'%'));

         $this->MySqlError($sql, "Erreur Mysql in function loadBookByKeyword()");

			
			$bookSQLTable = $query->fetchAll();
			$books = $this->getBooks($bookSQLTable);

			return $books;		 	

	}

	
	/* ******************************  Retourne la liste de tous les adhérents ***************************** */

	public function loadMembers(){

			$query = $this->connection->prepare("SELECT * FROM ADHERENT ORDER BY NOM ASC");
			$sql = $query->execute(array());
         $this->MySqlError($sql, "Erreur Mysql in function loadMembers()");
			
			$adherentSQLTable = $query->fetchAll();
			$members          = $this->getMembers($adherentSQLTable);

			return $members;
	}


	/* ******************************  Retourne une liste d'adhérent en fonction du nom ***************************** */
	
	public function loadMembersByName($name){

			$query = $this->connection->prepare("SELECT * FROM ADHERENT HAVING NOM  like ?  ORDER BY NOM ASC;");
			$sql = $query->execute(array($name.'%'));
         $this->MySqlError($sql, "Erreur Mysql in function loadMembersByName()");
			
			$adherentSQLTable = $query->fetchAll();
			
			$members = $this->getMembers($adherentSQLTable);

			return $members;
	}


	/* ******************************  Retourne une liste d'adhérent en fonction d'un ID  ***************************** */

	public function loadMembersByID($id){

			$query = $this->connection->prepare("SELECT * FROM ADHERENT HAVING Numero_ADHERENT  like ?  ORDER BY Numero_ADHERENT ASC;");
			$sql = $query->execute(array($id.'%'));
         $this->MySqlError($sql, "Erreur Mysql in function loadMembersByName()");
			
			$adherentSQLTable = $query->fetchAll();
			$members 			= $this->getMembers($adherentSQLTable);

			return $members;
		
	}

	
	/* ******************************  Retourne une liste d'adhérent en fonction d'un ID (json)  ***************************** */

	public function JsonloadMembersByID($id){

			$query = $this->connection->prepare("SELECT * FROM ADHERENT HAVING Numero_ADHERENT  like ?  ORDER BY Numero_ADHERENT ASC;");
			$sql = $query->execute(array($id.'%'));
         	$this->MySqlError($sql, "Erreur Mysql in function loadMembersByName()");
			
			$members = $query->fetchAll();
			
			return $members;
	 }



	/* ******************************  Retourne les prêt d'un adhérent  ***************************** */

	public function borrowingBooks($id_member){

			$query = $this->connection->prepare("	SELECT r.NOM, PRENOM, TITRE, t.CODE_BARRE, DATE_FORMAT(r.DATE_EMP,'%d-%m-%Y') DATE_EMP, 			
																t.DATE_RETOUR 
																FROM (SELECT PRET.NUMERO_ADHERENT,NOM, PRENOM,TITRE, PRET.CODE_BARRE, MAX(DATE_EMP) as DATE_EMP, 
																DATE_RETOUR FROM PRET,ADHERENT,LIVRE, OEUVRE  
																WHERE PRET.NUMERO_ADHERENT = ADHERENT.NUMERO_ADHERENT 
																AND PRET.CODE_BARRE = LIVRE.CODE_BARRE  AND  LIVRE.COTE=OEUVRE.COTE AND DISPONIBILITE=0  
										                  GROUP BY CODE_BARRE) r  INNER JOIN PRET t ON t.CODE_BARRE = r.CODE_BARRE 
																AND t.DATE_EMP = r.DATE_EMP 
																AND t.NUMERO_ADHERENT= ?" );

			$sql = $query->execute(array($id_member));
         $this->MySqlError($sql, "Erreur Mysql in function borrowingBooks()");
	
			$PretSQLTable = $query->fetchAll();
			
			return $PretSQLTable;

	}


	/* ******************************  Retourne la liste de tous les livres  ***************************** */

	public function loadBooks(){

			$query = $this->connection->prepare("	SELECT ISBN, DISPONIBILITE, DATE_ACHAT, LIVRE.COTE, CODE_BARRE, TITRE, 
																DATE_FORMAT(DATE_PARUTION , '%d-%m-%Y') DATE_PARUTION , NOM_AUTEUR, 
																PRENOM_AUTEUR, NOM_EDI, DATE_FORMAT(DATE_ACHAT , '%d-%m-%Y') DATE_ACHAT,
																NUMERO_EXEMPLAIRE 
																FROM LIVRE, OEUVRE, AUTEUR, REDIGER,EDITEUR  
																WHERE LIVRE.COTE = OEUVRE.COTE 
															   AND LIVRE.COTE = REDIGER.COTE 
																AND AUTEUR.ID_AUTEUR = REDIGER.ID_AUTEUR 
																AND LIVRE.ID_EDITEUR = EDITEUR.ID_EDITEUR;");
	
			$sql = $query->execute(array());
          $this->MySqlError($sql, "Erreur Mysql in function loadBooks()");

			
			$bookSQLTable = $query->fetchAll();
			$books        = $this->getBooks($bookSQLTable);

			return $books;		 	
	}



		/* ******************************  Retourne la liste de tous les livres portant le même titre  ***************************** */
	
		 public function loadBooksByTitle($title){

			$query = $this->connection->prepare("	SELECT ISBN, DISPONIBILITE, DATE_ACHAT, LIVRE.COTE, CODE_BARRE, TITRE, 
																DATE_FORMAT(DATE_PARUTION , '%d-%m-%Y') DATE_PARUTION , NOM_AUTEUR, 
																PRENOM_AUTEUR, NOM_EDI, DATE_FORMAT(DATE_ACHAT , '%d-%m-%Y') DATE_ACHAT,
																NUMERO_EXEMPLAIRE 
																FROM LIVRE, OEUVRE, AUTEUR, REDIGER,EDITEUR  
																WHERE LIVRE.COTE = OEUVRE.COTE 
															   AND LIVRE.COTE = REDIGER.COTE 
																AND AUTEUR.ID_AUTEUR = REDIGER.ID_AUTEUR 
																AND LIVRE.ID_EDITEUR = EDITEUR.ID_EDITEUR
																AND TITRE LIKE ?");
	
			$sql = $query->execute(array($title.'%'));
			$this->MySqlError($sql, "Erreur Mysql in function borrowingBooks()");

			$bookSQLTable = $query->fetchAll();
			$books 		  = $this->getBooks($bookSQLTable);
	

			return $books;		 	
	}


	/* ******************************  Retourne une liste des livres écrit par un auteur  ***************************** */

	public function loadBooksByAuthor($author){

			$query = $this->connection->prepare("	SELECT ISBN, DISPONIBILITE, DATE_ACHAT, LIVRE.COTE, CODE_BARRE, TITRE, 
																DATE_FORMAT(DATE_PARUTION , '%d-%m-%Y') DATE_PARUTION , NOM_AUTEUR, 
																PRENOM_AUTEUR, NOM_EDI, DATE_FORMAT(DATE_ACHAT , '%d-%m-%Y') DATE_ACHAT,
																NUMERO_EXEMPLAIRE 
																FROM LIVRE, OEUVRE, AUTEUR, REDIGER,EDITEUR  
																WHERE LIVRE.COTE = OEUVRE.COTE 
															   AND LIVRE.COTE = REDIGER.COTE 
																AND AUTEUR.ID_AUTEUR = REDIGER.ID_AUTEUR 
																AND LIVRE.ID_EDITEUR = EDITEUR.ID_EDITEUR
																AND ( NOM_AUTEUR LIKE ? OR PRENOM_AUTEUR LIKE ?) ");
	
			$sql = $query->execute(array($author.'%',$author.'%'));
			$this->MySqlError($sql, "Erreur Mysql in function  loadBooksByAuthor()");

			$bookSQLTable = $query->fetchAll();
			$books        = $this->getBooks($bookSQLTable);
	
			return $books;		 	
	}



 	/* ******************************  Retourne une liste de livres ayant le même ISBN ***************************** */

 	public function searchBook($ISBN){

		$command = "SELECT ISBN, DISPONIBILITE, DATE_ACHAT, LIVRE.COTE, CODE_BARRE, TITRE,  
						DATE_FORMAT(DATE_PARUTION , '%d-%m-%Y') DATE_PARUTION , NOM_AUTEUR, 
						PRENOM_AUTEUR, NOM_EDI, DATE_FORMAT(DATE_ACHAT , '%d-%m-%Y') DATE_ACHAT, NUMERO_EXEMPLAIRE,MOT_CLES  
						FROM LIVRE, OEUVRE, AUTEUR, REDIGER,EDITEUR,CARACTERISE, MOT_CLE 
						WHERE LIVRE.COTE = OEUVRE.COTE 
						AND LIVRE.COTE = REDIGER.COTE  
						AND AUTEUR.ID_AUTEUR = REDIGER.ID_AUTEUR  
						AND LIVRE.ID_EDITEUR = EDITEUR.ID_EDITEUR 
						AND CARACTERISE.NUM_MOTCLE=MOT_CLE.NUM_MOTCLE 
						AND LIVRE.COTE=CARACTERISE.COTE 
					   AND ISBN=? ";

		 $query   =  $this->connection->prepare($command);
		 $sql 	 =	 $query->execute(array($ISBN));

		$this->MySqlError($sql, "Erreur Mysql in function searchBook()");

		$searchBookkSQLTable = $query->fetchAll();

		return $searchBookkSQLTable;
	}



	/* ******************************  Retourne l' ID d'un Éditeur ***************************** */
	
  private function selectPublisher($publisher){

		$command =   "SELECT * FROM EDITEUR WHERE NOM_EDI=?";
		$query   =   $this->connection->prepare($command);
		$sql 	   =	 $query->execute(array($publisher));

		$this->MySqlError($sql, "Erreur Mysql in function selectPublisher()");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return $row[0];
    	}

		$command    =   "INSERT INTO EDITEUR (ID_Editeur, NOM_EDI) VALUES (:ID_Editeur, :NOM_EDI)";
		$query      =   $this->connection->prepare($command);
		$rand 		= rand(1000,10000);
		$sql 	      =	 $query->execute(array(':ID_Editeur'=>$rand, ':NOM_EDI'=>$publisher));
      
		$this->MySqlError($sql, "Erreur Mysql in function selectPublisher() 2");
	
		return $rand;
	}


	/* ******************************  Retourne l' ID d'un auteur ***************************** */

	private function selectAuthor($nom, $prenom){

		$command =   "SELECT * FROM AUTEUR WHERE NOM_AUTEUR=? AND PRENOM_AUTEUR=?";
		$query   =   $this->connection->prepare($command);
		$sql 	   =	 $query->execute(array($nom, $prenom));

		$this->MySqlError($sql, "Erreur Mysql in function selectAuthor()");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return $row[0];
    	}
	
		return false;
	}

	
	/* ******************************  Ajoute un auteur dans la table auteur ***************************** */

	private function addAuthor($nom, $prenom){

		$command =   "SELECT * FROM AUTEUR WHERE NOM_AUTEUR =? AND PRENOM_AUTEUR=? ";
		$query   =   $this->connection->prepare($command);
		$sql 	   =	 $query->execute(array($nom, $prenom));

		$this->MySqlError($sql, "Erreur Mysql in function addAuthor()");
	
		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return true;			
    	}
	
		$command    =   "INSERT INTO AUTEUR (ID_AUTEUR, NOM_AUTEUR, PRENOM_AUTEUR) VALUES (:ID_AUTEUR, :NOM_AUTEUR, :PRENOM_AUTEUR)";
		$query      =   $this->connection->prepare($command);
	   $id_auteur  =   rand(10000,100000);
		$sql 	      =	 $query->execute(array(':ID_AUTEUR'=>$id_auteur, ':NOM_AUTEUR'=>$nom,':PRENOM_AUTEUR'=>$prenom ));

		if(!$sql){
				echo "Erreur MySQL   addAuthor";
				print_r($this->connection->errorInfo());
				return false;
		}

		return true;
	}


	/* ******************************  Vérifie si une oeuvre existe  ***************************** */ 

	public function searchTitle($title){

		$command =   "SELECT * FROM OEUVRE WHERE TITRE = ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($title));
		$this->MySqlError($sql, "Erreur Mysql in function searchTitle()");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     			return true;
    	}

		return false;
	}


		/* ******************************  Vérifie si une cote existe ***************************** */ 

		public function searchCOTE($cote){

			$command =   "SELECT * FROM OEUVRE WHERE COTE = ?";
			$query   =   $this->connection->prepare($command);

			$sql = $query->execute(array($cote));
			$this->MySqlError($sql, "Erreur Mysql in function searchCOTE()");

			while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return true;
    		}

			return false;
	 }


	/* ******************************  Ajoute une oeuvre ***************************** */ 

	public function addOeuvre($title, $cote, $nom, $prenom,$keyword,$releaseDate){

		$command =   "SELECT * FROM OEUVRE WHERE COTE= ? AND TITRE= ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($title, $cote));
		$this->MySqlError($sql, "Erreur Mysql in function addOeuvre");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return true;
    	}


		$searchTitle = $this->searchTitle($title);
		$searchCote  = $this->searchCote($cote);
		$id_author   = $this->selectAuthor($nom, $prenom);

		if(!$searchCote && !$searchCote ){

	   	$command    =   "INSERT INTO OEUVRE(COTE, TITRE, DATE_PARUTION) VALUES (:COTE, :TITRE, :DATE_PARUTION)";
			$query      =   $this->connection->prepare($command);
			$sql 	      =	 $query->execute(array(':COTE'=>$cote, ':TITRE'=>$title,':DATE_PARUTION'=>$releaseDate ));

			$this->MySqlError($sql, "Erreur Mysql in function addOeuvre 1");
			$query->errorInfo();

			$command    =   "INSERT INTO REDIGER(ID_AUTEUR, COTE) VALUES (:ID_AUTEUR, :COTE)";
			$query      =   $this->connection->prepare($command);
			$sql 	      =	 $query->execute(array(':ID_AUTEUR'=>$id_author, ':COTE'=>$cote));

			$this->MySqlError($sql, "Erreur Mysql in function addOeuvre 2");
			
			$this->insertKeyword($cote, $keyword);

			return true;
		}
	
		return false;

	}


	/* ******************************  Ajoute des mots clé  ***************************** */

	public function insertKeyword($cote, $keyword){

		echo " ";
		$rand = rand(10000, 100000);

		$command = "INSERT INTO MOT_CLE (NUM_MOTCLE, MOT_CLES) VALUES (:NUM_MOTCLE,:MOT_CLES )";
		$query   =   $this->connection->prepare($command);
		$sql 	   =	 $query->execute(array(':NUM_MOTCLE'=>$rand, ':MOT_CLES'=>$keyword));
			
    	$this->MySqlError($sql, "Erreur Mysql in function insertKeyword 1");

		$command = "INSERT INTO  CARACTERISE (NUM_MOTCLE, COTE) VALUES (:NUM_MOTCLE,:COTE)";
		$query   =   $this->connection->prepare($command);
		$sql 	   =	 $query->execute(array(':NUM_MOTCLE'=>$rand, ':COTE'=>$cote));
		
	  $this->MySqlError($sql, "Erreur Mysql in function insertKeyword 2");
		$error = $query->errorInfo();
		
		return true;
	}


	/* ******************************  Ajoute un livre ***************************** */
	
public function addBook($book){

		$id_editeur = $this->selectPublisher($book['editeur']);
		$author     = $this->addAuthor($book['nom_auteur'], $book['prenom_auteur']);
		$oeuvre     = $this->addOEUVRE($book['titre'], $book['cote'],$book['nom_auteur'], $book['prenom_auteur'],$book['mot-cle'],
										       date("Y-m-d", strtotime($book['date_parution'])));

		

		$command =   "INSERT INTO LIVRE (CODE_BARRE, ISBN, DISPONIBILITE, NUMERO_EXEMPLAIRE, DATE_ACHAT, ID_EDITEUR, COTE) 
							VALUES (:CODE_BARRE, :ISBN, :DISPONIBILITE,:NUMERO_EXEMPLAIRE,:DATE_ACHAT, :ID_EDITEUR,:COTE) ";
		$query   =   $this->connection->prepare($command);		
		$rand 	= rand(1000,10000);
	
      $sql 	   =	 $query->execute(array(':CODE_BARRE'=>$book['code'],
													  ':ISBN'=>$book['isbn'],
													  ':DISPONIBILITE'=>'1',
													  ':NUMERO_EXEMPLAIRE'=>$rand,
											 		  ':DATE_ACHAT'=>date("Y-m-d", strtotime($book['date_achat'])),
													  ':ID_EDITEUR'=>$id_editeur,
													  ':COTE'=>$book['cote']));
		$error = $query->errorInfo();	
    	$this->MySqlError($sql, "Erreur Mysql in function addBook");
		
		return true;

	}

   /* ******************************  Vérifie si un code barre existe ***************************** */

	public function checkCodeBarre($code){

	  
		$command =   "SELECT * FROM LIVRE WHERE CODE_BARRE= ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($code));
		$this->MySqlError($sql, "Erreur Mysql in function CheckCodeBarre");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return false;
    	}

		return true;
	}


	/* ******************************  Vérifie la cote correspond au bon titre ***************************** */

	public function checkShelfMark($title, $cote){

		$command =   "SELECT * FROM OEUVRE WHERE COTE= ? AND TITRE= ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($title, $cote));
		$this->MySqlError($sql, "Erreur Mysql in function  CheckShelfMark");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return false;
    	}

		return true;
	}



	/* ******************************  Retourne l'adhérent qui emprunte ce livre ***************************** */
	
  public function borrowingByBook($bookNumber){

		$command =   " SELECT NOM, PRENOM, DATE_EMP, DATE_RETOUR, PROLONGATION,TITRE, NUMERO_EXEMPLAIRE,DISPONIBILITE   
							FROM ADHERENT, PRET, LIVRE, OEUVRE 
							WHERE LIVRE.COTE=OEUVRE.COTE 
							AND PRET.CODE_BARRE = LIVRE.CODE_BARRE 
							AND ADHERENT.Numero_ADHERENT= PRET.Numero_ADHERENT 
							AND NUMERO_EXEMPLAIRE=?
							AND DISPONIBILITE=0";
		
		$query   =   $this->connection->prepare($command);
		$sql     = $query->execute(array($bookNumber));

		$this->MySqlError($sql, "Erreur Mysql in function  CheckShelfMark");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return $row;
    	}

		return false;
	}


	/* ******************************  Historique des adhérents qui ont emprunté ce livre ***************************** */

	public function historyByBook($bookNumber){

	
		$command =   " SELECT NOM, PRENOM, DATE_EMP, DATE_RETOUR, PROLONGATION,TITRE, NUMERO_EXEMPLAIRE,DISPONIBILITE   
							FROM ADHERENT, PRET, LIVRE, OEUVRE 
							WHERE LIVRE.COTE=OEUVRE.COTE 
							AND PRET.CODE_BARRE = LIVRE.CODE_BARRE 
							AND ADHERENT.Numero_ADHERENT= PRET.Numero_ADHERENT 
							AND NUMERO_EXEMPLAIRE=? ";
		
		$query   =   $this->connection->prepare($command);
		$sql 		= $query->execute(array($bookNumber));

		$this->MySqlError($sql, "Erreur Mysql in function historyByBook");
		
		$result = $query->fetchAll();

		return $result;

	}



	/* *************************** Retourne le code barre du livre en fonction de son numero d'exemplaire ************************** */

	public function getBookCode($id_book){

		$command =   "SELECT * FROM LIVRE WHERE NUMERO_EXEMPLAIRE=?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($id_book));
		$this->MySqlError($sql, "Erreur Mysql in function getBookCode");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return $row[0];
    	}

		return false;
	}


	/* *************************** Vérifie si l'ID de l'Adhérent existe ************************** */

	public function checkMemberCode($id_member){


		$command =   "SELECT  Numero_ADHERENT   FROM ADHERENT WHERE  Numero_ADHERENT=?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($id_member));
		$this->MySqlError($sql, "Erreur Mysql in function getMemberCode");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return true;
    	}

		return false;

	}


	/* *************************** Vérifie si un livre est disponible ************************** */

	public function checkAvailabilityBook($id_book){

		$command =   "SELECT * FROM LIVRE WHERE NUMERO_EXEMPLAIRE=?  AND  DISPONIBILITE=1";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($id_book));
		$this->MySqlError($sql, "Erreur Mysql in function checkAvailabilityBook");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return true;
    	}

		return false;
	}



  /* *************************** Mise à jour de la disponibilité d'un livre ************************** */

	public function updateAvailabilityBook($availability,$code){


		$command =   "UPDATE LIVRE SET  DISPONIBILITE =  ? WHERE  CODE_BARRE = ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($availability,$code));
		$this->MySqlError($sql, "Erreur Mysql in function updateAvailabilityBook");

		return true;
	}



	 /* *************************** Enregistrement de l'emprunt d'un livre  ************************** */
  
	 public function saveBorrowingBook($id_code, $id_member){
		
		$this->updateAvailabilityBook(0,$id_code);

		$date1 = new DateTime('today');
		$date2 = new DateTime('+1 month');

		$start = $date1->format('Y-m-d');
		$end   = $date2->format('Y-m-d');

		$command =   "INSERT INTO PRET(NUMERO_ADHERENT, CODE_BARRE, DATE_EMP, DATE_RETOUR, Prolongation) 
						 VALUES(:NUMERO_ADHERENT,:CODE_BARRE,:DATE_EMP,:DATE_RETOUR ,:Prolongation)";

		$query  =   $this->connection->prepare($command);
		$sql 	  =	$query->execute(array( ':NUMERO_ADHERENT'=>$id_member,
													  ':CODE_BARRE'=>$id_code,
													  ':DATE_EMP'=>$start,
													  ':DATE_RETOUR'=>$end,
													  ':Prolongation'=>0));

		//print_r($query->errorInfo());

		$this->MySqlError($sql, "Erreur Mysql in function saveBorrowingBook");
	
		return true;
	}

		
	 /* *************************** Vérifie le retour d'un livre   ************************** */

	public function checkGivingBackBook($code){

		$command =   "SELECT * FROM LIVRE WHERE CODE_BARRE=? AND DISPONIBILITE=1";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($code));
		$this->MySqlError($sql, "Erreur Mysql in function checkAvailabilityBook");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return false;  // ce livre est disponible, un retour du pret est impossible (livre déjà rendu)
    	}

		return true; // ce livre n'est pas disponible, le retour de ce livre est attendu

	}		
	
	
	 /* *************************** Vérifie si l'adhérent à emprunter ce livre   ************************** */

	public function checkBorrowingBook($code, $id_member){

		$command =   "SELECT * FROM PRET, LIVRE HAVING  Numero_ADHERENT= ?  AND LIVRE.CODE_BARRE=PRET.CODE_BARRE 
						  AND  PRET.CODE_BARRE=? AND DISPONIBILITE=0  ORDER BY DATE_RETOUR DESC LIMIT 1 ";
	
   	$query   =   $this->connection->prepare($command);
		$sql 		= $query->execute(array($id_member,$code));
		
		$this->MySqlError($sql, "Erreur Mysql in function checkBorrowingBook");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return true;  
    	}

		return false; 
	}	


	 /* ********************** Retourne la liste des adhérents qui n'ont pas rendu un ou des livres  ************************* */

 	public function loadMembersLate(){

			$query = $this->connection->prepare("SELECT distinct PRET.Numero_ADHERENT, NOM, PRENOM, SEXE  
																FROM LIVRE, ADHERENT,PRET 
																WHERE LIVRE.CODE_BARRE=PRET.CODE_BARRE  
																AND PRET.NUMERO_ADHERENT=ADHERENT.NUMERO_ADHERENT   
																AND DATE(NOW()) > DATE_RETOUR  AND DISPONIBILITE=0");

			$sql = $query->execute(array());
         $this->MySqlError($sql, "Erreur Mysql in function loadMembersLate()");
			
			$result = $query->fetchAll();
	
			return $result;
	}

	
	public function loadMemberLate($id_member){

			$query = $this->connection->prepare("  SELECT * FROM LIVRE, PRET, ADHERENT,OEUVRE 
																HAVING LIVRE.CODE_BARRE=PRET.CODE_BARRE  
																AND  DATE(NOW()) > DATE_RETOUR  
																AND DISPONIBILITE=0 
																AND ADHERENT.NUMERO_ADHERENT=PRET.NUMERO_ADHERENT
																AND LIVRE.COTE = OEUVRE.COTE
																AND PRET.NUMERO_ADHERENT = ? ");

			$sql = $query->execute(array($id_member));
         $this->MySqlError($sql, "Erreur Mysql in function loadMemberLate()");	
			$result = $query->fetchAll();
		

			return $result;

	}
	

	 /* ********************** Modifie les données sur un adhérent ************************* */

	public function updateMember($member){

		$command = "UPDATE  ADHERENT SET  
					   NOM =  ?, PRENOM = ?, VILLE = ?, SEXE = ?, ADRESSE =  ?, COURRIEL =  ?,  TELEPHONE = ?, DATE_NAISSANCE=?
						WHERE  ADHERENT.Numero_ADHERENT = ? ";

		 $query   =  $this->connection->prepare($command);
		 
		 $sql 	 =  $query->execute(array($member['nom'],  $member['prenom'], $member['ville'],
													  $member['sexe'], $member['adresse'], $member['e_mail'],
													  $member['telephone'], $member['date_naissance'], 
													  $member['id_adherent'] 
													) );
						
		$this->MySqlError($query, "Erreur Mysql in function Member()");
	
		return true;	
   }


	 /* ********************** Reservation d'une oeuvre ************************* */

	public function reserveThisBook($cote, $id_member){

	
		
		$date = new DateTime('today');
		$today   = $date->format('Y-m-d');

		
		$command =   "INSERT INTO RESERVE(NUMERO_ADHERENT, COTE, DATE_RESERVATION, DATE_LIM) 
						  VALUES(:NUMERO_ADHERENT,:COTE,:DATE_RESERVATION,:DATE_LIM )";

		$query  =   $this->connection->prepare($command);
		$sql 	  =	$query->execute(array(':NUMERO_ADHERENT'=>$id_member,':COTE'=>$cote,':DATE_RESERVATION'=>$today,':DATE_LIM'=>"0000-00-00"));

		//print_r($query->errorInfo());

		$this->MySqlError($sql, "Erreur Mysql in function saveBorrowingBook");
	
		return true;
				
	}

	/* *** Ajout d'une date limite pour une resevation lors du retour d'un livre correspondant à l'oeuvre réservé par un adhérent *** */

	public function updateLimitReservation($code, $id_member){

      $cote = NULL;

		$command =   "SELECT COTE FROM LIVRE  WHERE CODE_BARRE= ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($code));
		$this->MySqlError($sql, "Erreur Mysql in function updateLimitReservation 1");

		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				$cote = $row[0];
    	}

		$date    = new DateTime('+1 week');
		$today   = $date->format('Y-m-d');

		$command =   "UPDATE RESERVE SET  DATE_LIM = ? WHERE  COTE = ? AND Numero_ADHERENT= ?";
		$query   =   $this->connection->prepare($command);

		$sql = $query->execute(array($today,$cote,$id_member));
		$this->MySqlError($sql, "Erreur Mysql in function updateLimitReservation 2");

	}


   /* ********************** Vérifie si une oeuvre est reservé ************************* */

	public function checkBookIsReserved($code){

		$command = "SELECT * FROM RESERVE, LIVRE WHERE LIVRE.COTE=RESERVE.COTE AND DATE_LIM=\"0000-00-00\" AND LIVRE.CODE_BARRE= ? 
						 ORDER BY DATE_RESERVATION ASC LIMIT 1";
		$query   =  $this->connection->prepare($command);
		$sql 	 	=  $query->execute(array($code) );
	
		$this->MySqlError($sql, "Erreur Mysql in function  checkBookIsReserved");
		//print_r($query->errorInfo());


		while ($row = 	$query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     				return $row[0];
    	}
	
		return false;
		
	}



	/* ********************** Retourne la liste des livres reservés ************************* */

	public function reservationList(){

	$query = $this->connection->prepare(" SELECT RESERVE.NUMERO_ADHERENT, NOM, PRENOM, SEXE, TELEPHONE, RESERVE.COTE, TITRE,  
															  DATE_FORMAT(DATE_RESERVATION , '%d-%m-%Y') DATE_RESERVATION,  
															  DATE_FORMAT(DATE_LIM , '%d-%m-%Y') DATE_LIM 
															  FROM RESERVE, ADHERENT, OEUVRE 
															  WHERE ADHERENT.NUMERO_ADHERENT=RESERVE.NUMERO_ADHERENT 
															  AND RESERVE.COTE=OEUVRE.COTE");

			$sql = $query->execute(array());
         $this->MySqlError($sql, "Erreur Mysql in function borrowingBooks()");
	
			$reservationList = $query->fetchAll();
			
			return $reservationList;

	}

	
}

