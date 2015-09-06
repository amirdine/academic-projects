<?

require_once("actions/Action.inc.php");

class ManageMemberAction extends Action {

			
	
	public function run() {
	
		$members = $this->database->loadMembers();
		$this->setView(getViewByName("ManageMember"));
		$this->getView()->setMembers($members);
			
	}
	  

}

?>

