<?

require_once("actions/Action.inc.php");

class SaveReservationBookAction extends Action {


	
	public function run() {
	
			$id_member  = $_POST['id_adherent'];
			$cote      	= $_POST['cote'];


			$checkMemberID = $this->database->checkMemberCode($id_member);
			$checkCote     = $this->database-> searchCOTE($cote);
			

			if(!$checkMemberID){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Cet Adhérent n'existe pas", "error");
				return false;
		 	}

			if(!$checkCote){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Cette cote n'existe pas", "error");
				return false;
		 	}
			

			$reservation 	= $this->database->reserveThisBook($cote, $id_member);
        

			if(!$reservation){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Echec de la reservation", "error");
				return false;
		 	}

		$this->setView(getViewByName("Message"));
		$this->getView()->setMessage("Réservation enregistrée", "success");


		
	}
	  

}

?>

