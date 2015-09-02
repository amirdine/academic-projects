<?
require_once("views/View.inc.php");

class SurveysView extends View {

	private $surveys;

	/**
	 * Affiche la liste des sondages.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {

		if (count($this->surveys)===0) {
			echo '<div class="container"><br>br><br><br><div style="text-align:center" class="alert"> Auncun sondage dispnible</div></div>';
			return;
		}
		
		require("templates/surveys.inc.php");
	}
	

	 public function setSurveys($surveys) {
	 	 $this->surveys = $surveys;
	 }
	
}
?>
