<?

require_once("actions/Action.inc.php");

class ManageSelectMemberAction extends Action {


	
	public function run() {
	
		$selectMember 		= $_POST['pageid'];
		$members 	  		= $this->database->loadMembers();
		$borrowingBooks	= $this->database->borrowingBooks($selectMember);
		$this->setView(getViewByName("ManageMember"));
		$this->getView()->selectMember($members,$selectMember,$borrowingBooks);		
	}
	  

}

?>

