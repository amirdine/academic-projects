<?
require_once("views/View.inc.php");

class ArrayGameView extends HTMLView {
	
	/**
	 * Affiche le formulaire d'inscription.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {
		require("templates/gameform.inc.php");
	}

}
?>
