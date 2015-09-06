<?
require_once("views/View.inc.php");

class LoginFormView extends View {

	/**
	 * Affiche le formulaire d'ajout de sondage.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {
		require("templates/loginform.inc.php");
	}


		
}
?>


