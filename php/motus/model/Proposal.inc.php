<?
class Proposal {
	

	private $proposal;
	private $secretword;
	private $color = array();

	public function __construct($secretword,$proposal) {
     
		$this->secretword = $secretword;
		$this->proposal = $proposal;
		$this->Setcolor($secretword, $proposal);
	}

   
	public function getProposal(){
		return $this->proposal;
	}

	public function  getSecretWord(){
		return $this->secretword;
	}

	public function getColor(){
		return $this->color;
	}	
	
	


	private function Setcolor($secretword, $proposal){
	
	
	for( $i = 0; $i < 8; $i++ ){

		if($secretword[$i] === $proposal[$i]){
			$this->color[$i] = "red";
			$secretword[$i] = '*';
			$proposal[$i] =  '*';

		}else{
		 $this->color[$i]	= "#0033CC";
		}
	}

	for($i = 0; $i < 8; $i++){
		if($proposal[$i] !==  '*'){
			for($j = 0; $j < 8; $j++){
			  if( $proposal[$i]== $secretword[$j]){
						 $this->color[$i]	= "#A5DF00";
						 $proposal[$i] =  '*';
						 $secretword[$j] =  '*';
						break;
				}
			}
		}
	}


}
  
	
}
?>
