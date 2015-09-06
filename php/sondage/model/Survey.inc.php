<?
class Survey {
	
	private $id ;
	private $owner;
	private $question;
	private $responses;
	private $comments = array();

	public function __construct($owner, $question) {
		$this->id = null;
		$this->owner = $owner;
		$this->question = $question;
		$this->responses = array();
	}

	public function setId($id) {
		$this->id = $id;
		
	}

	public function getId() {
		return $this->id;
	}

	public function getOwner() {
		return $this->owner;
	}
	
	public function getQuestion() {	
		return $this->question;
	}

	public function &getResponses() {
		return $this->responses;
	}

	public function setResponses($responses) {
		$this->responses = $responses;
	}
	
	public function addResponse($response) {
		$this->responses[] = $response;
	}
	
	public function computePercentages() {
		/* TODO START */
				
			 $total = 0;

			 foreach ($this->getResponses() as $response){
			  $total = $response->getCount() + $total;
			}

			 foreach ($this->getResponses() as $response){
			   $response->computePercentage($total);
			}
				
		/* TODO END */
	}

	/**************** AJOUT FONCTIONNALITÉS *********************** */

		public function addComment($comment) {
		 $this->comments[] = $comment;
	   }

	public function &getComments() {
		return $this->comments;
	}


}
?>
