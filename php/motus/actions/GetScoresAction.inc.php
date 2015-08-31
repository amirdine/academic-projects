<?

require_once("actions/Action.inc.php");

class GetScoresAction extends Action {

	
	
	public function run() {
	
	   
	    
		$scores = $this->database->loadScores();
		
		
		$this->setView(getViewByName("JSON"));
        $this->getView()->setObject($scores);
		
	}
	  

}

?>
