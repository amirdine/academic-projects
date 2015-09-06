<?

require_once("actions/Action.inc.php");

class SearchMemberAction extends Action {

			
	
	public function run() {
	
		$member = NULL;

		 $option = $_POST['search_member'];
		 $arg		= $_POST['argument'];
		
		if( $option == "nom"){
		  $members = $this->database->loadMembersByName($arg);
		}
	
		if( $option == "id"){
		  $members = $this->database->loadMembersByID($arg);
		}

		$this->setView(getViewByName("ManageMember"));
		$this->getView()->setMembers($members);
			
	}
	  

}

?>

