
<?
require_once("views/View.inc.php");

class ManageMemberView extends View {
	

	private $members       		=  NULL;
	private $selectMember  		=  NULL;
	private $borrowingBooks		= 	NULL;
	
	public function displayBody() {

		require("templates/managemember.inc.php");
	}
	
	public function setMembers($members){

		$this->members = $members;
	}
	
	public function selectMember($members,$selectMember, $borrowingBooks){

			$this->members       	=  $members;
			$this->selectMember  	=  $selectMember;
			$this->borrowingBooks	=  $borrowingBooks;

	}

}
?>


