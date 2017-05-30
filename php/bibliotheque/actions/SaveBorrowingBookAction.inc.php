<?

require_once("actions/Action.inc.php");

class SaveBorrowingBookAction extends Action {


	
	public function run() {
	

			$id_member  = $_POST['adherent'];
			$id_book    = $_POST['livre'];

			
			$getBookCode 		      = $this->database->getBookCode($id_book);
         $checkMemberCode  		= $this->database->checkMemberCode($id_member);
			$checkAvailabilityBook  = $this->database->checkAvailabilityBook($id_book);
			$checkMemberLate		   = $this->database->loadMemberLate($id_member);
			$borrowingBooks	      = $this->database->borrowingBooks($id_member);
			$bookNumber             = count($borrowingBooks);

			if(!$getBookCode){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Ce numéro ne correspond à aucun livre", "error");
				return false;
		 	}

	
		
			if($checkMemberLate){

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Emprunt annulé: cet adhérent n'a pas rendu tous ces livres", "error");
			return false;
		  }

			if($checkMemberLate){

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Emprunt annulé: cet adhérent n'a pas rendu tous ces livres", "error");
			return false;
		  }


			if($bookNumber > 2){

				$this->setView(getViewByName("Message"));
				$this->getView()->setMessage("Cet Adhérent a emprunté plus de 3 livres", "error");
				return false;
		   }
			

		  $saveBorrowingBook = $this->database-> saveBorrowingBook($getBookCode,$id_member);
			

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Enregistrement du prêt terminé", "success");
			
	

		
	}
	  

}

?>

