<?

require_once("actions/Action.inc.php");

class RegisterBookAction extends Action {

	
	public function run() {
	
	
		$this->setView(getViewByName("RegisterBookForm"));
	
			
	}
	  

}

?>

