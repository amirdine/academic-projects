<?

require_once("actions/Action.inc.php");


class StartGameAction extends Action {

	
	
	public function run() {
	
	   $values = explode("\n",file_get_contents("mots.txt" ));
        function make_seed()
        {
         list($usec, $sec) = explode(' ', microtime());
         return (float) $sec + ((float) $usec * 100000);
         }
        srand(make_seed());
        
      $player = $this->getSessionLogin() ;
		$secretword = strtolower ($values[rand( 1 , 18060 )]);
	    
	   $this->database->reset();

	$this->setView(getViewByName("Motus"));
	$this->database->SessionGames($player);

	}
	  

}

?>
