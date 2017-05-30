<?

require_once("actions/Action.inc.php");

class JsonSearchMemberAction extends Action {

			
	
	public function run() {
	
		
		$id_member		= $_POST['id_member'];
	    $members = $this->database->JsonloadMembersByID($id_member);
		echo json_encode($members);
			
	}
	  

}

?>

