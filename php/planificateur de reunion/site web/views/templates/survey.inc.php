
</br></br></br></br>

<?
		require_once("model/RowGenerator.inc.php");

		$survey 	=   $this->survey;
		$lenght	=   $survey->getTimeSlotsNumber();

		$rowGenerator = new RowGenerator() ;
?>

		<div  class="container" >
   	<form action="index.php?action=AnswerSurvey" method="post">

		<b>Titre du sondage:</b> <? echo $survey->getTitle()   ?> </br>
		<b>Commentaire: </b>     <? echo $survey->getComment() ?> </br></br><br>
	
		<table BORDERCOLOR="#FFFFFF" border="1"  cellpadding="5" cellspacing="10px">
		<tr>
			<td> </td>


<?
		$t = $rowGenerator->getHTMLYearRow($survey);
	
		foreach($t as $value){
		 	$cellSize = $value[0];
			echo "<td  bgcolor=\"#A4A4A4\"  align=\"center\" colspan=\"$cellSize\">".$value[1]." </td>";
		}
?> 	
		</tr>
		<tr>
	 	  <td> </td>
<?
    	$t = 	$rowGenerator->getHTMLMonthRow($survey);
	 	
		foreach($t as $value){
			$cellSize = $value[0];
			echo "<td bgcolor=\"#D8D8D8\"  align=\"center\" colspan=\"$cellSize\">".$value[1]." </td>";
		}
?>
   	</tr>
		<tr>
	 		<td> </td>
<?
    	$t = $rowGenerator->getHTMLRow($survey);
	 
		foreach($t as $value){
			$cellSize= $value[0];
			echo "<td bgcolor=\"#EFEFEF\"  align=\"center\" colspan=\"$cellSize\">".$value[1]." </td>";
		}
?>
  	 </tr>
		 <tr>
	 		<td> </td>
<?
	   for($i = 0; $i < $lenght; $i++){
	   	$hour = $survey->getTimeSlots();
      	echo "<td bgcolor=\"#EFEFEF\">".$hour[$i]->getStartTime()."-".$hour[$i]->getEndTime()." </td>";  
	   }
?>
   </tr>
	<tr>
			<td bgcolor="#EFEFEF"> <input type="text" name="FirstName"> </td>
<?
	 for($i = 0; $i < $lenght; $i++){
		$name = $hour[$i]->getId();
      echo "<td bgcolor=\"#EFEFEF\" align=\"center\">  <input type=\"checkbox\" name=\"response[]\" value=\"$name\">  </td>";	  
	 }
?>
   
	</tr>
		</table>
		<p><input type="hidden" name="survey_id" value=" <? echo $survey->getID() ?>"></p>
		<input class="btn btn-danger" type="submit" value="Valider">
   	</form>
   </div>
	 
