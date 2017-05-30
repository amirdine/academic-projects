<?
require_once("views/View.inc.php");
require_once("views/HTMLView.inc.php");

class MotusView extends HTMLView {

	private $motus;
	
	/**
	 * Affiche le formulaire d'inscription.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {
		require("templates/gameform.inc.php");
	}

	 public function setMotus($motus) {
	 	 $this->motus = $motus;
	 }

}
?>
