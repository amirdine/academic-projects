<?

require_once("actions/Action.inc.php");

class LoginFormAction extends Action {

	
	public function run() {
		
	
		
		   $this->setView(getViewByName("LoginForm"));
	
	
  }
   
   
 
}
?>
