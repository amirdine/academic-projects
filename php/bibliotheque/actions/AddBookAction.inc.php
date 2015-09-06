<?

require_once("actions/Action.inc.php");
require_once("model/Member.inc.php");


class AddBookAction extends Action {

		
	public function run() {
	
	$book = $_POST; 

	$checkCodeBarre = $this->database->checkCodeBarre($book['code']);
   $checkShelfMark = $this->database->checkShelfMark($book['titre'],$book['cote']);
	
	if(!$checkCodeBarre){

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Ce code barre existe déjà", "error");
			return false;
		}

	if(!$checkShelfMark){

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("La cote saisie ne correspond pas au titre de ce livre", "error");
			return false;
	 }

		$sql  = $this->database->addBook($book);
		
		if(!$sql){

			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("Erreur lors de l'enregistrement du livre", "error");
			return false;
	 }
		

		$this->setView(getViewByName("Message"));
		$this->getView()->setMessage("Enregistrement du Livre réussi", "success");
 
	}
}
?>
