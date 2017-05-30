<?
require_once("views/View.inc.php");

class MessageView extends View {

	/**
	 * Affiche un message à l'utilisateur.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() { 
		
		echo '<center>  <div class=" '.$this->style. '">'.$this->message.'</div> </center>';
	}

}
?>
