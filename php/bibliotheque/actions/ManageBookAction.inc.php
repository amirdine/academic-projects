<?

require_once("actions/Action.inc.php");

class ManageBookAction extends Action {

	
	public function run() {
	
		$books = $this->database->loadBooks();
		$this->setView(getViewByName("ManageBook"));
		$this->getView()->setBooks($books);
			
	}
	  

}

?>

