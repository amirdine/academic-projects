<?

require_once("actions/Action.inc.php");

class LookBooksAction extends Action {

	
	public function run() {
	
		$books = $this->database->loadBooks();
		$this->setView(getViewByName("MyBooksSearch"));
		$this->getView()->setBooks($books);
			
	}
	  

}

?>

