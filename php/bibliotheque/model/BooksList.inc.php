<?
class booksList {
	
	private $bookList;
	private $delay;
	private $book = array();
	


  public function addBook($book) {
		$this->book[] = $book;
	}
	

	public function getBooks() {
		return $this->book ;
	}



	public function getBook($id){
		for($i = 0; $i < count($this->book); $i++){
			if( $this->book[$i]->getNumber() == $id){
				return $this->book[$i];
			}
		}
		return false;
	}
	


	

}

?>
