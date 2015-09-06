<?

require_once("actions/Action.inc.php");

class SearchBookAction extends Action {

			
	
	public function run() {
	
		$ISBN = $_POST['isbn'];
		$searchBook = $this->database-> searchBook($ISBN);
		echo json_encode($searchBook);
			
	}
	  

}

?>

