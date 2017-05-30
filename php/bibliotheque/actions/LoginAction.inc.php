<?

require_once("actions/Action.inc.php");

class LoginAction extends Action {

			
	
	public function run() {

		$nickname  =  $_POST['nickname'];
		$password  =  $_POST['password'];

		$checkMemberPassword = $this->database->checkMemberPassword($nickname);

		if($checkMemberPassword==true && $password=="password"){
			
			$selectMember 		= $nickname;
			$members 	  		= $this->database->loadMembers();
			$borrowingBooks	= $this->database->borrowingBooks($selectMember);
		   $this->setView(getViewByName("MySpace"));
		   $this->getView()->selectMember($members,$selectMember,$borrowingBooks);		
			
			return true;

		}

		if($nickname =="admin" && $password== "password"){

				
			$login = $nickname;
			$this->setSessionLogin($login);
			$this->setView(getViewByName("Message"));
			$this->getView()->setMessage("connexion réussie", "success");
		
			header( "refresh:1.25;url=?action=Admin" );
		
			return true;	
		}


		$this->setView(getViewByName("LoginForm"));
		$this->getView()->setMessage("Identifiant ou mot de passe incorrect.", "error");
		return false;

	}
	  

}

?>

 
