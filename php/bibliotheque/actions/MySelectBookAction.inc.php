<?

require_once("actions/Action.inc.php");

class MySelectBookAction extends Action {


	
	public function run() {
	
		$selectBook			  = $_POST['pageid'];
		$books	  			  = $this->database->loadBooks();
		$borrowingByBook	  = $this->database->borrowingByBook($selectBook);	
		$historyByBook      = $this->database->historyByBook($selectBook);	

	
		$this->setView(getViewByName("MyBooksSearch"));

		$this->getView()->selectBook($books,$selectBook,$borrowingByBook, $historyByBook);
	}
	  

}

?>

