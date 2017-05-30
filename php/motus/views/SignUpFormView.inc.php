
<?
require_once("views/View.inc.php");
require_once("views/HTMLView.inc.php");

class SignUpFormView extends HTMLView {
	
	/**
	 * Affiche le formulaire d'inscription.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {
		require("templates/signupform.inc.php");
	}

}
?>


