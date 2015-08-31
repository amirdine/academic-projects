<?
require_once("views/View.inc.php");
require_once("views/HTMLView.inc.php");

class MessageView extends HTMLView {

	/**
	 * Affiche un message à l'utilisateur.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody() { 
		echo '<div class="container"><br>br><br><br><div style="text-align:center" class="alert '.$this->style.'">'.$this->message.'</div></div>';
		echo "<div id=\"scoreboard\" ></div>";
	}

}
?>
