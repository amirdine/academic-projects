<?

require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");
require_once("actions/Action.inc.php");

class AddSurveyAction extends Action {

	/**
	 * Traite les données envoyées par le formulaire d'ajout de sondage.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * Sinon, la fonction ajoute le sondage à la base de données. Elle transforme
	 * les réponses et la question à l'aide de la fonction PHP 'htmlentities' pour éviter
	 * que du code exécutable ne soit inséré dans la base de données et affiché par la suite.
	 *
	 * Un des messages suivants doivent être affichés à l'utilisateur :
	 * - "La question est obligatoire.";
	 * - "Il faut saisir au moins 2 réponses.";
	 * - "Merci, nous avons ajouté votre sondage.".
	 *
	 * Le visiteur est finalement envoyé vers le formulaire d'ajout de sondage en cas d'erreur
	 * ou vers une vue affichant le message "Merci, nous avons ajouté votre sondage.".
	 * 
	 * @see Action::run()
	 */
	public function run() {
	
	if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}
		

	       $question = htmlentities($_POST['questionSurvey']);
	  
			$reponse1 = htmlentities ($_POST['responseSurvey1']);
			$reponse2 = htmlentities ($_POST['responseSurvey2']);
  			$reponse3 = htmlentities ($_POST['responseSurvey3']);
	  		$reponse4 = htmlentities ($_POST['responseSurvey4']);
   		    $reponse5 = htmlentities ($_POST['responseSurvey5']);
   
  			$reponse = array($reponse1 ,$reponse2, $reponse3, $reponse4, $reponse5);
   
   	if(!isset($question) || trim($question)===''){
			$this->setAddSurveyFormView("La question est obligatoire !");
			return false;
   	}
  
  		$compteur = 0;
  
  		for($i = 0; $i < 5 ; $i++){
  			if(empty($reponse[$i]))
  		 	$compteur = $compteur+1;
     }
   
   
  		if($compteur > 3){
						$this->setAddSurveyFormView("Il faut saisir au moins 2 réponses");
			return;
  		}else{
  
   			$owner = $this->getSessionLogin();
   			$survey = new Survey($owner, $question);
   
   			$this->setMessageView("Merci, nous avons ajouté votre sondage.", "alert-success");
   
	 	for($i = 0; $i < 5 ; $i++){
			if(!empty($reponse[$i]))
				 $survey->addResponse(new Response($survey,$reponse[$i], 0));
	 	}
	 
      	$query = $this->database->saveSurvey($survey);
      
    	if(!$query){ 
     		$this->setAddSurveyFormView("Erreur lors de l'ajout de votre sondage dans la base de données.");
  	 		return false;
  	 	}
   }
   
	
  }

	private function setAddSurveyFormView($message) {
		$this->setView(getViewByName("AddSurveyForm"));
		$this->getView()->setMessage($message, "alert-error");
	}

}

?>
