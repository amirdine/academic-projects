<?

	
class Book {
	
	private $code;
	private $purchaseDate;
	private $book = array();
	
	

	public function __construct($book) {
				
		$this->book = $book;	
		
	}
	

	public function setLibraryBookData($code,$purchaseDate){
		
		$this->code 		   = $code;
		$this->purchaseDate 	= $purchaseDate;
  }
	
	
	public function getCode(){
		return $this->code;
	}

	public function getPurchaseDate(){
		return $this->purchaseDate;
	}

	public function getISBN(){
		return $this->book['isbn'];
	}

	public function getAvailability(){
			$availability = $this->book['disponibilite'];
			if($availability)
             return "oui";
			else 	
				return "non";
	}


	public function getPublisher(){
		return $this->book['editeur'];
	}


	public function getRareBookShelf(){
		return $this->book['cote'];
	}

	public function getTitle(){
		return $this->book['titre'];
	}

	public function getFamilyNameOfAuthor(){
		return $this->book['nom_auteur'];
	}
	
	public function  getFirstNameOfAuthor(){
		return $this->book['prenom_auteur'];
	}

	public function getPublicationDate(){
		return $this->book['date_parution'];
	}

	public function getNumber(){
		return $this->book['numero_exemplaire'];
	}
	

}

?>
