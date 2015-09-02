<?
require_once("views/View.inc.php");


class SurveyView extends View {

	private$survey;

	/**
	 * Affiche un sondage.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {

		if (count($this->survey)===0) {
			echo '<div class="container"><br>br><br><br><div style="text-align:center" class="alert">Aucun sondage ne correspond à votre demande.</div></div>';
			return;
		}
		
		require("templates/survey.inc.php");
	}
	
	
	 public function setSurvey($survey) {
	 	 $this->survey =$survey;
	 }
	
}
?>
