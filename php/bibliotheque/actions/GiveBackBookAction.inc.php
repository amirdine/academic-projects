<?

require_once("actions/Action.inc.php");

class GiveBackBookAction extends Action {


	
	public function run() {
	

	
		$this->setView(getViewByName("GiveBackBook"));

		
	}
	  

}

?>

