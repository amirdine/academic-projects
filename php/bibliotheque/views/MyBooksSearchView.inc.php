
<?
require_once("views/View.inc.php");

class MyBooksSearchView extends View {
	
	private $books       			=  NULL;
	private $selectBook  			=  NULL;
	private $borrowingByBook  		=  NULL;
	private $historyByBook        =  NULL;


	public function displayBody() {
		require("templates/mybookssearch.inc.php");
	}

	public function setBooks($books){

		$this->books = $books;
	}
	
	public function selectBook($books,$selectBook,$borrowingByBook, $historyByBook){

			$this->books       		=  $books;
			$this->selectBook 	   =  $selectBook;
			$this->borrowingByBook  =  $borrowingByBook;
			$this->historyByBook    =  $historyByBook;

	}
}
?>


