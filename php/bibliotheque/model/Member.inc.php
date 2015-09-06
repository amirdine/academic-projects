<?

	
class Member {
	
	private $id;
	private $registrationDate;
	private $datePayement;
	private $civilStatus = array();
	
	

	public function __construct($civilStatus) {
				
		$this->civilStatus = $civilStatus;	
	}
	
	public function setLibraryMemberData($id,$registrationDate,$datePayement){
		
		$this->id 				= $id;
		$this->registrationDate = $registrationDate;
		$this->datePayement 	= $datePayement;			
	}
	
	
	public function getId(){
		return $this->id;
	}

	public function getRegistrationDate(){
		return $this->registrationDate;
	}

	public function getFamillyName(){
		return $this->civilStatus['nom'];
	}

	public function getFirstName(){
		return $this->civilStatus['prenom'];
	}

	public function getSex(){
		return $this->civilStatus['sexe'];
	}

	public function getDateOfBirth(){
		return $this->civilStatus['date_de_naissance'];
	}


	public function getAddress(){
		return $this->civilStatus['adresse'];
	}

	public function getEmail(){
		return $this->civilStatus['email'];
	}

	public function getPhoneNumber(){
		return $this->civilStatus['Telephone'];
	}
	
	public function getCity(){
		return $this->civilStatus['Villes'];
	}

	public function getPayementDate(){
		return $this->datePayement;
	}

	

}

?>
