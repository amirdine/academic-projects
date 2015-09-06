<?

require_once("actions/Action.inc.php");

class SaveUpdateMemberAction extends Action {

			
	
	public function run() {
	
	 	$member = $_POST;
		$checkMember 		= $this->database->checkMemberPassword($member['id_adherent']);
	 	$saveUpdateMember = $this->database->updateMember($member);


		if(!$checkMember ){
			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Cet adhérent n'existe pas", "error");
			return false;
		}
		
	 
		if(!$saveUpdateMember){
		
			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Echec de la mise à jour", "error");
			return false;
		}
		
		$this->setView(getViewByName("Message"));
		$this->getView()->setMessage("	Mise à jour réussi", "success");
		
			
	}
	  

}

?>

