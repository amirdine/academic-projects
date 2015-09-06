<?

require_once("actions/Action.inc.php");

class SaveGivingBackBookAction extends Action {


	
	public function run() {
	

			$id_member  = $_POST['adherent'];
			$id_book    = $_POST['livre'];

			
			$getBookCode 			= $this->database->getBookCode($id_book);
            $checkMemberCode  		= $this->database->checkMemberCode($id_member);
			$checkGivingBackBook    = $this->database->checkGivingBackBook($getBookCode);
			$checkBorrowingBook     = $this->database->checkGivingBackBook($getBookCode , $id_member);
			$checkReservation       = $this->database->checkBookIsReserved($getBookCode);
		

			if(!$getBookCode){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Ce numéro ne correspond à aucun livre", "error");
				return false;
		 	}

			if(!$checkMemberCode){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Ce numéro ne correspond à aucun adhérent", "error");
				return false;
		  }

			if(!$checkGivingBackBook){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Ce livre a déjà été rendu", "error");
				return false;
		  }

			if(!$checkBorrowingBook){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("l'adhérent n'a jamais emprunté ce livre", "error");
				return false;
		  }

	
			$updateAvailabilityBook = $this->database->updateAvailabilityBook(1,$getBookCode);

			if(!$updateAvailabilityBook){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Erreur lors de l'enregistrement du retour", "error");
				return false;
		  }

			$this->database->updateLimitReservation($getBookCode , $id_member);
		
			if($checkReservation  != false){

			
				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Retour du livre enregistré: Ce livre  a été reservé par l'adhérent n° $checkReservation", "error");
				return false;
		  }

			

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Retour du livre enregistré", "success");
			
	

		
	}
	  

}

?>

