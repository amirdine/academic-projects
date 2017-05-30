<?

require_once("actions/Action.inc.php");

class SearchBookOptionAction extends Action {

			
	
	public function run() {
	
		 $book = NULL;

		 $option = $_POST['search_book'];
		 $arg		= $_POST['argument'];


		if($option=="titre"){
			$books = $this->database->loadBooksByTitle($arg);
		}

		if($option=="auteur"){
			$books = $this->database->loadBooksByAuthor($arg);
		}

		if($option=="mot-cle"){
			$books = $this->database->loadBookByKeyword($arg);
		}

		$this->setView(getViewByName("ManageBook"));
		$this->getView()->setBooks($books);
			
			
	}
	  

}

?>

