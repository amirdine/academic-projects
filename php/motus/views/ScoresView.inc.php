<?
require_once("views/View.inc.php");
require_once("views/HTMLView.inc.php");

class ScoresView extends HTMLView {

	private $scores;

	/**
	 * Affiche la liste des sondages.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {

		
		
		require("templates/scoresview.inc.php");
	}
	
	/**
	 * Fixe les sondages à afficher.
	 *
	 * @param array<Survey> $scores Sondages à afficher. 
	 *
	 */
	 public function setScores($scores) {
	 	 $this->scores = $scores;
	 }
	
}
?>
