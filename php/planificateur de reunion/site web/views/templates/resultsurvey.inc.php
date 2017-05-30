
<?
		require_once("model/RowGenerator.inc.php");

		/* resultat.inc.php permet d'afficher les résultats du sondage */
		$survey = $this->survey;
		$lenght = $survey->getTimeSlotsNumber();

		$rowGenerator = new RowGenerator() ;
?>	

		<div  class="container" >;	
			<form  method="post" action="index.php?action=Export" class="modal">
			</br> 
			<center>
				<table BORDERCOLOR="#FFFFFF" border="1"  cellpadding="3"  cellspacing="3" >
				<tr>
				<td> </td>
						
<?  	/* 
		 * $exportInfo: stock les infos nécessaire à la génaration d'un talbeau pour 
		 * exporter au format PDF et Excel;
		 */

		$exportInfo[0][]  = array(" ", "black"); 
	

		/* On genere les cellules affichant le ou les année(s) */
    	$years = $rowGenerator->getHTMLYearRow($survey);
	
		foreach($years as  $value){
		 
			$cellSize = $value[0]; // cellSize: pour savoir le nombre de case qu'occupe l'année
			$exportInfo[0][]  = array($value[1], $cellSize);
?>
	  		<td bgcolor="#A4A4A4"  align="center" colspan="<?echo $cellSize?>"> <?echo $value[1]?> </td>
<?     }
?>		 
		</tr>	
       <tr> 
           <td> </td>
<?	 
     	 /* On genere les cellules affichant le ou les mois */ 
   		$exportInfo[1][]  = array(" ", "black");
   		$months =  $rowGenerator->getHTMLMonthRow($survey);
	 
	   	foreach($months as $value){
	   		$cellSize= $value[0];
	   		$exportInfo[1][] = array($value[1], $cellSize);
?>
	  			 <td bgcolor="#D8D8D8"  align="center" colspan="<? echo $cellSize ?>"> <? echo $value[1] ?> </td>
<?        }
?>
    		 </tr>
		    <tr>
			   <td> </td>
<?
			 /* On genere les cellules affichant le ou les Jour(s) + la date */
			 $exportInfo[2][]  = array(" ", 1);
			 $day =  $rowGenerator->getHTMLRow($survey);

			 foreach($day as $value){
				$cellSize= $value[0];
				$exportInfo[2][] = array($value[1], $cellSize);
?>
      	   <td bgcolor="#EFEFEF"  align="center" colspan="<? echo $cellSize ?>">  <? echo $value[1] ?> </td>
<?        }
?>
			</tr>
         <tr>
        	   <td> </td>
<?   
	 		/* On genere les cellules affichant les créneau horraires */
   
			$exportInfo[3][] = array(" ", 1);

			for($i = 0; $i < $lenght; $i++){
	    		$time = $survey->getTimeSlots();
				$exportInfo[3][] = array($time[$i]->getStartTime()."-".$time[$i]->getEndTime(), 1);
?>
            <td bgcolor="#EFEFEF"> <? echo $time[$i]->getStartTime() ?> - <? echo $time[$i]->getEndTime()?> </td>
<?       }
?>     
			</tr>
<?
   		/* On genere les cellules affichant les disponibilité des personnes à chaque créneau horraire */ 
   		$availability = $survey->getResponses();
   		$index = 4;
   
			foreach( $availability  as $ligne){
		 
				echo "<tr>";
		
				$name = getUser($ligne);
	    		$exportInfo[$index][]  = array($name,1);

		  		echo "<td  bgcolor=\"#EFEFEF\"  align=\"left\"> $name</td>"	;
		
		  		foreach($ligne  as $value){
			 		if($value->getDisponibility() == "OK"){
						$color  = "#43CF88";
						$string = "OK";
						$exportInfo[$index][]  = array("OK", 1);
		  			}else{
						$color  = "#FF7A75";
						$string = " ";
						$exportInfo[$index][]  = array(" ", 1);
			    }
					 
			    echo "<td  bgcolor=\"$color\"  align=\"center\">";
             echo $string;
			    echo "</td>";
		    }
			echo "</tr>";	
			$index++;	
		}

	/* On genere l'affichage du nombre de personne disponible par créneau horaire */
	echo "<tr>";
	echo "<td> Nombre </td>";
	
	$exportInfo[$index+1][]  = array("Nombre",1);
	$numbers = $survey->getDisponibilityNumbersByTimeSlot();
	
	/* Permet le nombre de personne du meilleur créneau horraire */
	$MaxNumberAvailablePersons = $survey->getMaxNumberAvailablePersons();
	
	foreach($numbers as $value){
	
	  $exportInfo[$index+1][]  = array($value,1);
	  if($value == $MaxNumberAvailablePersons ){
	  	  echo "<td align=\"center\"> <font color=\"red\"> <b>$value</b> </font></td>";	 
	  }

	  if($value != $MaxNumberAvailablePersons ){
	  	  echo "<td align=\"center\">  $value </td>";
	  }
	}
	echo "</tr>";
	echo "</table> </center>";
	echo "</br></br>";
?>
 
 	<input type='hidden' name='disponibility' value="<?php echo htmlentities(serialize($exportInfo)); ?>" />
	<center>
		<input class="btn btn-primary" type="submit"  name ="exportToPDF"	   value="Exporter au format PDF" />
		<input class="btn btn-primary" type="submit"	 name ="exportToExcel"  value="Exporter au format Excel" />	
	</center>
  	</br></br>
  	</form>
   </div>

<? 
 function getUser($ligne){
 	foreach($ligne  as $value){			
         return  $value->getUser();
	}
 }
?>
