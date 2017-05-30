<?

require_once("actions/Action.inc.php");


class ProposalAction extends Action {

	private function loadMotus($secretword, $tableau){

   	$color = array();
		$arrayMotus = $tableau;

		$owner = $this->getSessionLogin();
		$motus = new Motus($owner, $secretword);

		for($i=0; $i < count($arrayMotus) ; $i++ ){	
           $proposal = new Proposal($secretword, $arrayMotus[$i]);
			  $motus->addProposal($proposal);    			
		}
			
		return $motus;
}



public function run() {
		/* TODO START */
    	
		$tableau = $_POST["tableau"]; // contient tous les mots insérer par le joueur.
		$proposal= $_POST["word"];
	   $time = $_POST["chrono"]; // temps entre le début de la partie et la l'envoie d'un mot.
		
	    
		if(!isset($proposal) || trim($proposal)===''){
			$this->setMessageView("Vous devez entrer un mot de 8 lettres", "alert-error");
			return false;
		}

        if(strlen($proposal) != 8){
           $this->setMessageView("Vous devez entrer un mot de huit lettres", "alert-error");
			return false;
        }
      
        
		 $secretword = $this->database->getSecretWord(); 
		
		 $motus = $this->loadMotus($secretword, $tableau);
		 $this->setView(getViewByName("JSON"));
       $this->getView()->setObject($motus->getColors());
       
       $owner = $this->getSessionLogin();
		
      if($motus->getResult()){
		 	$this->database->addPointWon($owner, $time);
		}
	

		/* TODO END */
	}

}

?>





