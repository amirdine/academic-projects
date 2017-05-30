<?
require_once("views/View.inc.php");

class DefaultView extends View {

	protected function displayBody() { 
	require("templates/default.inc.php");
	}
	
	
}
?>

