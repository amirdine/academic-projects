<?

require_once("actions/Action.inc.php");

class CurrentGameSessionAction extends Action {

public function run() {
		/* TODO START */
     
        $owner = $this->getSessionLogin();
        if($owner == NULL){
        echo "vous devez être connecté";
        return false;
        }

		$motus = $this->database->loadMotus($owner);
		$this->setView(getViewByName("Motus"));
		$this->getView()->setMotus($motus);


		/* TODO END */
	}

}

?>





