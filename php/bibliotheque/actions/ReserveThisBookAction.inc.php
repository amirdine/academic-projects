<?

require_once("actions/Action.inc.php");

class ReserveThisBookAction extends Action {


	
	public function run() {
	
			

         $reservationList = $this->database->reservationList();
			$this->setView(getViewByName("ReserveThisBook"));
			$this->getView()->setReservationList($reservationList);
			


		
	}
	  

}

?>

