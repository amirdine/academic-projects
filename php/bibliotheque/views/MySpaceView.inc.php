
<?
require_once("views/View.inc.php");

class MySpaceView extends View {

	private $members       		=  NULL;
	private $selectMember  		=  NULL;
	private $borrowingBooks		= 	NULL;
	
	public function displayBody() {

		require("templates/myspace.inc.php");
	}
	
	
	
	public function selectMember($members,$selectMember, $borrowingBooks){

			$this->members       	=  $members;
			$this->selectMember  	=  $selectMember;
			$this->borrowingBooks	=  $borrowingBooks;

	}	

}
?>


