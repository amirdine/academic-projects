
<?
require_once("views/View.inc.php");

class AdminPanelView extends View {
	
	/**
	 * Affiche le formulaire d'inscription.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() {
		require("templates/adminpanel.inc.php");
	}

}
?>


