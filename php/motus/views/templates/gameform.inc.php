
<div id="scoreboard" ></div>
<div id="motus"  class="motus">
<div id="erreur"> </div>
<table border="2" bordercolor="#FFFFFF" style="background-color:#0033CC" width="100%" cellspacing=13 cellpadding=15 align="center">
	
<?  

$motus = $this->motus;
$endGameSession = false;

if($motus != NULL){
   $proposal = $this->motus->getArray();

	
	for($i=0; $i<6; $i++){

	echo " \n <tr> \n";

	if(@$proposal[$i] == NULL){
		for($j=0; $j<8; $j++)
		echo "<td align=\"center\" > <b style=\"color:#0033CC\"> * </b> </td>";	
	}

 	if(@$proposal[$i] != NULL){

		$word  = $proposal[$i]->getProposal();
  	 	$color = $proposal[$i]->getColor();

		for($j=0; $j<8; $j++)
			echo "<td bgcolor=\"$color[$j]\" align=\"center\" > <b style=\"color:white\"> $word[$j] </b> </td>";
			if( $motus->getResult())
		    $endGameSession = true;
	}
	
	echo"\n </tr> \n";
}

	
}


if($motus == NULL){
for($i=0; $i<6; $i++){
	echo " \n <tr> \n";
	for($j=0; $j<8; $j++)
		echo "<td align=\"center\" > <b style=\"color:#0033CC\"> * </b> </td>";
	echo"\n </tr> \n";
}
}




?>
</div>	
	
</table>
</br>

<?

if($endGameSession){

echo"<div><div style=\"text-align:center\" class=\"alert alert-success\">Bravo !!! </div></div>";
return true;

}


if(!$endGameSession){


/*echo "<form method=\"post\" action=\"index.php?action=Proposal\" >";
echo "<input type=\"text\" name=\"jouer\" class=\"controls\">";
echo "<input class=\"btn\" type=\"submit\" value=\"valider\">";
echo "</form>";

*/


echo "<input id=\"word\" type=\"text\" name=\"jouer\" class=\"controls\">";
echo "<input id=\"send\" class=\"btn\" type=\"submit\" value=\"valider\">";




}


?> 



  





	


