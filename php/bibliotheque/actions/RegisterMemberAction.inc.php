<?

require_once("actions/Action.inc.php");

class RegisterMemberAction extends Action {

	
	public function run() {
	
	
		$this->setView(getViewByName("RegisterMemberForm"));
	
			
	}
	  

}

?>

