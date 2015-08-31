<?
  class Scores{
     
     private $pseudo ;
	  private $played_games;
	  private $won_games;
	  private $average_time;
	  private $score;
	  
	  
	  public function __construct($pseudo,$played_games,$won_games,$average_time) {
		$this->pseudo = $pseudo;
		$this->played_games = $played_games;
		$this->won_games = $won_games;
		$this->average_time = $average_time;
	 }
	
	
	 public function getPseudo() {
		return $this->pseudo;
	 }

	public function getPlayedGames() {
		return $this->played_games;
	}
	
	public function getWonGames() {	
		return $this->won_games;
	}

	public function getAverageTime() {
		return $this->average_time;
	}
	
	
	}
	
	?>
