<?	
require_once("views/View.inc.php");

class UpdateUserFormView extends HTMLView {

	/**
	 * Affiche le formulaire de modification de mot de passe.

	 * @see View::displayBody()
	 */
	public function displayBody() {
		require("templates/updateuserform.inc.php");
	}

}
?>

