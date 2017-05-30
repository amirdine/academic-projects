<?
class Motus{


   private $owner=null;
   private $secretword;
   private $Proposal=null;
   private $Array = array();
   
   public function __construct($owner,$secretword) {
      $this->owner = $owner;
		$this->secretword = $secretword;
	}
	

	private function setProposal($Proposal) {
		$this->Proposal = $Proposal;
	}


	public function getSecretWord() {
		return $this->secretword;
	}
	
	public function getProposal() {	
		return $this->Proposal;
	}

	public function getLastProposal() {	
		 return @$this->getProposal()->getProposal();
	}

	public function getProposals() {
		return $this->Array;
	}
	
	public function addProposal($Proposal) {
		 $this->Array[] = $Proposal;
		 $this->setProposal($Proposal);	
	}

	public function getResult(){
		
		$proposal 	= $this->getLastProposal();
		$secretword = $this->getSecretWord();
		if($proposal !=  $secretword){
			return false;
		}
	
		return true;	
	}


	public function getColors(){
		
		$proposals = $this->getProposals();
		$colors = array();
		
		for($i=0; $i < count($proposals); $i++){			
			 $colors[$i] = $proposals[$i]->getColor();
		}
		
		return $colors;
	}

 
}
?>
   
