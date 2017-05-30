<br><br><br><br><br><br>
				

<div class="container">	
		<h2> Mes sondages </h2>
	  <div class="table-responsive">  
<br>
<br>
<br>
		     <?  $surveys = $this->surveys; 
               $lenght  =	count($surveys)	;
					
				?>
			
					<table  class="table">
						<tr>
							<td> <b>  </b> </td>
							<td> <b>Titre</b> </td>
							<td> <b>Lien </b></td>
							<td> <b>Résultat </b></td>
						 </tr>

						<? for($i = 0; $i < $lenght ; $i++){ ?>
							  	
								<? $link    = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=GetSurvey&id=".$surveys[$i][0];
									$title   = $surveys[$i][1];
									$result  = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=GetResultSurvey&id=".$surveys[$i][0];
								?>
								<tr>
									<td > <? echo $i+1 ?></td>
									<td ><? echo $title ?> </td>
									<td ><? echo "<a target=\"_blank\" href=\"$link\" >$link</a>" ?> </td>
									<td ><? echo "<a target=\"_blank\" href=\"$result\" >sondage n°".$surveys[$i][0]."</a>" ?> </td>
						 		</tr>	
						
						<? } ?>

					</table>
</div>
</div>
