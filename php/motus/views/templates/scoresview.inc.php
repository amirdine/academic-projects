</br></br></br></br>
<div class="container">
<table class="table table-striped table-bordered" >
<? 

$scores = $this->scores;

?>
<tbody><tr><th>Pseudo</th><th>Parties jouées</th><th>Parties gagnées</th><th>Temps moyens</th></tr>
<?

for($i = 0; $i < count($scores); $i++){
   
	$pseudo         = $scores[$i]->getPseudo();
	$PartiesJouees  = $scores[$i]->getPlayedGames();
	$PartiesGagnees = $scores[$i]->getWonGames();
   $TempsMoyen     = $scores[$i]->getAverageTime();

	echo "<tr><td> $pseudo </td><td>$PartiesJouees</td><td>$PartiesGagnees</td><td>$TempsMoyen</td></tr>";
}
?>
</tbody></table></div>


