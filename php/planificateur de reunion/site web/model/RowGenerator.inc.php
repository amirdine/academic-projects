<?


class RowGenerator {

	/**
    * @class  La classe RowGenerator permet de créer un tableau pour afficher
	 * un sondage ou le résultat d'un sondage en prenant en compte les que certains
	 * mois, année, jour doivent occuper une ou plusieurs case(s) ou cellule(s).
    */

	public function __construct( ) {
	
	}

	public function getHTMLRow($survey){

	   $cpt   = 1;
	   $index = 0;

		$lenght= $survey->getTimeSlotsNumber();
		$time = $survey->getTimeSlots();

		$t[0][0] = $cpt;
		$t[0][1] = $time[0]->getWeekDay()." ".$time[0]->getDayNumber() ;		 		

		for($i = 0; $i < $lenght ; $i++){
       	
	    	if($i > 0){
				if($this->compareTwoDates($time[$i]->getDate(), $time[$i-1]->getDate()) == 0 ){
        			$cpt++;
				}

				if($this->compareTwoDates($time[$i]->getDate(), $time[$i-1]->getDate()) != 0){
       			$cpt=1;
		 		   $index++;
				}
          
	  			$t[$index][0] = $cpt;
				$t[$index][1] = $time[$i]->getWeekDay()." ".$time[$i]->getDayNumber() ;		 
			} 			
	  }
      return $t;
}


private function compareTwoDates($firstDate, $secondDate){
	

	$date1 = new DateTime($firstDate);
	$date2 = new DateTime($secondDate);
	
	$interval = $date1->diff($date2);
	return $interval->format('%a');
}


public function getHTMLMonthRow($survey){

		$cpt   = 1;
	   $index = 0;

		$lenght= $survey->getTimeSlotsNumber();
		$time = $survey->getTimeSlots();
    		
		$t[0][0] = $cpt;
		$t[0][1] = $time[0]->getMonth();		

		for($i = 0; $i < $lenght; $i++){
       
			if($i > 0){
				if($time[$i]->getMonth() == $time[$i-1]->getMonth()){
        			$cpt++;
				}

				if($time[$i]->getMonth() != $time[$i-1]->getMonth()){
       			$cpt=1;
		 			$index++;
				}    
	  			$t[$index][0] = $cpt;
				$t[$index][1] = $time[$i]->getMonth();	 
			} 		
	  }
      return $t;
}


public function getHTMLYearRow($survey){

	   $cpt   = 1;
	   $index = 0;

		$lenght= $survey->getTimeSlotsNumber();
		$time  = $survey->getTimeSlots();

		$t[0][0] = $cpt;
		$t[0][1] = $time[0]->getYear();		

		for($i = 0; $i < $lenght; $i++){
       
			if($i > 0){
				if($time[$i]->getYear() == $time[$i-1]->getYear()){
        			$cpt++;
				}

				if($time[$i]->getYear() != $time[$i-1]->getYear()){
       			$cpt=1;
		 			$index++;
				}
          
	  			$t[$index][0] = $cpt;
				$t[$index][1] = $time[$i]->getYear() ;	 
			} 		
	  }
      return $t;
 }
	
}
?>
