<?

require_once("actions/Action.inc.php");

class BorrowBookAction extends Action {


	
	public function run() {
	

	
		$this->setView(getViewByName("BorrowBookForm"));

		
	}
	  

}

?>

