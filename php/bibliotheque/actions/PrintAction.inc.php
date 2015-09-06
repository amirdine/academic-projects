<?

require_once("actions/Action.inc.php");
require_once('actions/phpTopdf/PDF.php');

class PrintAction extends Action {


	
	public function run() {
	

		$members = $this->database->loadMembersLate();
		



		for($i=0; $i < count($members); $i++){

			$sex ;
	
			if($members[$i]['SEXE'] == "Masculin")
		 		$sex = "Monsieur";
			else
			 $sex = "Madame";
		
			$nom    = $members[$i]['NOM'];
			$prenom = $members[$i]['PRENOM'];

			$file = 'file'.$i.'.txt';

			$fp = fopen($file, 'w');
		
			fwrite($fp, "\n\n$sex $nom $prenom  \n\n");
			fwrite($fp, "Voici la liste des livres que vous devez rendre: \n\n");
		
			$books   =  $this->database->loadMemberLate($members[$i]['Numero_ADHERENT']);
			
			for($j=0; $j < count($books); $j++){
				
				$id_livre	  = $books[$j]['NUMERO_EXEMPLAIRE'] ;
				$titre 		  = $books[$j]['TITRE'] ;
				$date_emprunt = $books[$j]['DATE_EMP'] ;
				$date_retour  = $books[$j]['DATE_RETOUR'] ;
				
				fwrite($fp, "Livre ID: $id_livre   Titre: $titre   date d'emprunt: $date_emprunt   date de retour prevue: $date_retour\n");

			}
		
	
			fclose($fp);

		}

		


			$pdf = new PDF();
			$titre = 'Retard';
			$pdf->SetTitle($titre);
			$pdf->SetAuthor('Bibliotheque');

			for($i=0; $i < count($members); $i++){
				$file = 'file'.$i.'.txt';
				$num = $i+1;
				$pdf->AjouterChapitre($num,'Avertissement',$file);
			}
				$pdf->Output();

  
	
		//$this->setView(getViewByName("RegisterBookForm"));
	
			
	}
	  

}

?>

