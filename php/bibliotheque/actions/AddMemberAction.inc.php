<?

require_once("actions/Action.inc.php");
require_once("model/Member.inc.php");


class AddMemberAction extends Action {

		
	public function run() {
	
	
		$civilStatus 	    = 	$_POST;
		$registrationDate 	= 	date('Y-m-d');
		$datePayement 		= 	$civilStatus['date'];
		$id 				= 	$this->ramdomID();
	
		$checkMember = $this->CheckMember($civilStatus['nom'], $civilStatus['prenom'], $civilStatus['date_de_naissance']);	
		
		if(!$checkMember){
			$this->message("Message","Cette personne est déjà inscrite","error");
			return false;
		}
		
		$member = new Member($civilStatus);
		$member->setLibraryMemberData($id,$registrationDate,$datePayement);	
		
		$sql = $this->database->addMember($member);
		
		if(!$sql){
			$this->message("Message","DATABASE ERROR: ERREUR LORS DE L'INSCRIPTION","error");
			return false;
		}

		$this->message("Message","Inscription validé","success");
		return true;
	}



	private function message($view, $message, $type){
		$this->setView(getViewByName($view));
		$this->getView()->setMessage($message,$type);	
	}
	
	
	private function checkMember($name, $firstName, $dateOfBirth){
		return $this->database->CheckMember($name, $firstName, $dateOfBirth);
	}
	
	
	private function ramdomID(){	
		$min = 10000;  
        $max = 99999;
	 	
	 	return rand($min , $max );
	}

}

?>
