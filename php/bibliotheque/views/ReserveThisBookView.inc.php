<?
require_once("views/View.inc.php");

class ReserveThisBookView extends View {

	
	private $reservationList = NULL;
	private $id_member  		 = NULL;

	public function displayBody() {
		require("templates/reservethisbook.inc.php");
	}

	public function setReservationList($reservationList){

		$this->reservationList 	= $reservationList;
		

	}


		
}
?>


