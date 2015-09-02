<? 

	function generateInputForTimeSlot($n) {
?>
		<div class="control-group">
			<label> 
				<b>Créneau horaire n° <?php echo $n; ?> </b> 
			</label> 
			</br>
			 Date:&nbsp;&nbsp;  
			 	<input  type="text" id="time<?php echo $n; ?>" name="timeSlotDate<?php echo $n; ?>" > 
			 	</br></br> 
			  Debut: 
			   <?php display_hours_selector("startHour$n", "startHour$n") ?> 
			   	h
			   <?php display_minutes_selector("startMinute$n", "startMinute$n") ?>
				</br></br>
                
                Fin: &nbsp;&nbsp;&nbsp; 
                <?php display_hours_selector("endHour$n", "endHour$n") ?> 
                h  
				<?php display_minutes_selector("endMinute$n", "endMinute$n") ?>	
			    </br></br>
<? 
			
?>
	
</div>


<?
}


function display_hours_selector($id, $name){ 
?>
	<select id= <? echo $id ?> name= <? echo $name ?> >;
    <option value="null"> </option>";
<?	
	for($i=0; $i < 24; $i++){ 
		
		if($i < 10) { 
			$i = "0".$i ;
		}
		echo "<option value=\"$i\">$i</option>";
     }
 	echo"</select>";
}


function display_minutes_selector($id, $name){ 
?>

   	<select id= <? echo $id ?> name= <? echo $name ?> >;
    <option value="null"> </option>";
<?	
	for($i=0; $i < 60; $i++){ 
		if($i < 10){ 
			$i = "0".$i;
		}
	 echo "<option value=\"$i\">$i</option>";
     }
 	echo"</select>";
 }

?>


<form method="post" action="index.php?action=AddSurvey" class="modal">
	<div class="modal-header">
		<h3>Création d'un sondage</h3>
	</div> 
	<div class="form-horizontal modal-body">
		<?	if ($this->message!=="")
			echo '<div class="alert '.$this->style.'">'.$this->message.'</div>';
		?>
		<div class="control-group">
			<label class="control-label" for="questionSurvey">Sujet de la réunion</label>

			<div class="controls">
				<input class="span3" type="text" name="meetingSubject" placeholder="Jury M1 Informatique">
			   </br></br>
			    <textarea class="form-control" rows="2" name="comment" placeholder="Écrivez un commentaire ... "></textarea>
			</div>
		</div>
<? 
		
		for ($i = 1; $i <= 5; $i++)
			generateInputForTimeSlot($i);
?>
	</div>
	<div class="modal-footer">
		<input class="btn btn-danger" type="submit"	value="Poster le sondage" />
	</div>
</form>



