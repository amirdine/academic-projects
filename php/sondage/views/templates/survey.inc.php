
<li class="media well">
	<div class="media-body">
		<h4 class="media-heading"><?= $survey->getQuestion() ?></h4>
		<br>
	  
	 <?   /* TODO */
	      foreach ($survey->getResponses() as $response) {
	 ?>	
				<div class="fluid-row">
					<div class="span2"><? echo $response->getTitle(); ?></div>
						<div class="span2 progress progress-striped active">
						<div class="bar" style="width:  <? echo $response->getPercentage();?>%"></div>
					</div>
					<span class="span1">(<? echo $response->getPercentage();?>%)</span>
					<form class="span1" method="post" action="<? echo $_SERVER['PHP_SELF'].'?action=Vote';?>">
						<input type="hidden" name="responseId" value="<? echo $response->getId();?>"> 
						<input type="submit" style="margin-left:5px" class="span1 btn btn-small btn-success" value="Voter">
					</form>
				</div>
		<?
			 } 
		?>


	<? 
		foreach ($survey->getComments() as $comment) {
	?>
			<div>
				</br>
				 <table  width="100%" >
					<tr>
						<td align="left"> <? echo $comment->getOwner(); ?></td>
						<td align="right" valign="center">Posté: <?   echo $comment->getDate(); ?></td>
	   			</tr>
	   		</table>
				</br>
				<? echo $comment->getMessage(); ?>
			</div>

	<? 
		} 
	?>

</br> </br>
<form action="/sondages/index.php?action=Comment" method="post">
 
  <p>Commentaire:<br/></br>
   <textarea class="other" name="commentaire" rows="10" maxlength="1000" cols="100"></textarea>
  </p>
 
	<input type="hidden" name="surveyId" value="<? echo $survey->getId();?>">
   <input  class="btn " name="Valider" value="valider" type="submit"/>
   <input class= "btn" name="Effacer" value="Effacer" type="reset"/>
 
</form>

<?
 $owner 			= $survey->getOwner();
 $login        = $_SESSION['login'];
 $id_survey     = $survey->getId();

if(strtolower($login) == strtolower($owner)){
	
	echo " <form action=\"/sondages/index.php?action=DeleteSurvey\" method=\"post\"> \n";
	echo " <input type=\"hidden\" name=\"surveyId\" value=\"$id_survey\"> \n";
   echo "<input  class= \"btn btn-danger\" name=\"Supprimer\" value=\"Supprimer ce sondage\" type=\"submit\"/>";
	echo "</form> ";


}


?>
	
