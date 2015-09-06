<div class="barre2">
<ul id="menuAdmin">
<li><a href="index.php?action=LoginForm">MySpace</a></li>
<li><a href="index.php?action=LookBooks">Livres</a></li>
</ul>
</div>

<div id="option">
<b>Options</b></br>
</br>

<a href="#" class="blue-button" onclick="window.open('addmember.html'); "><font color="white">Modifier</font></a>
</div>





<? 






$members = $this->members->getMembers();
$id = $this->selectMember; 
$selectMember = $this->members->getMember($id);

if(!$selectMember){
	$id       	  = $members[0]->getId();
	$selectMember = $this->members->getMember($id);
}

?>

		</ul>
	</div>
</form>



<div id="fiche">
 

	<section id="wrapper" class="wrapper">

 
	<div id="v-nav">
		<ul>
    		<li tab="tab1" class="first current">Profil</li>
    		<li tab="tab2">Coordonnées</li>
    		<li tab="tab3">Prêts</li>
    		<li tab="tab4" class="last">Réservations</li>
 	</ul>

 	<div class="tab-content">
 		
		<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
			<tr> 
				<td> <b><font color="#fff">Adhérent n° <? echo $this->selectMember  ?></font></b> </td> 
			</tr>
		</table>
	</br>

	<b>Nom:</b> <? echo $selectMember->getFamillyName(); ?> &nbsp; &nbsp; &nbsp; &nbsp; 
   <b>Prénom:</b> <? echo $selectMember->getFirstName(); ?>  &nbsp; &nbsp; &nbsp; &nbsp;</br></br>
	<b>Date de naissance:</b>  <? echo $selectMember->getDateOfBirth(); ?> 
	</br></br>
 </div>

	
 <div class="tab-content">
 
	<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
	<tr> <td> <b><font color="#fff">Coordonnées</font></b> </td> </tr>
	</table>

</br>
<b>Adresse:</b> <? echo $selectMember->getAddress(); ?>  &nbsp; &nbsp; &nbsp; &nbsp;
<b> Code Postal:</b> 14870 &nbsp; &nbsp; &nbsp; &nbsp; </br> </br><b>Ville:</b> <? echo $selectMember->getCity(); ?> 

</br></br>
<b>courriel:</b> <? echo $selectMember->getEmail(); ?>    &nbsp; &nbsp; &nbsp; &nbsp; <b>Tél:</b> <? echo $selectMember->getPhoneNumber(); ?> 
</br>
		

 </div>


 <div class="tab-content">
    <table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
<tr> <td> <b><font color="#fff">Prêts</font></b> </td> </tr>
</table>
</br>
<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="100%" cellpadding="3" cellspacing="0">
	<tr>
		<td><b>Titre du Livre</b></td>
		<td><b>Date du Prêt</b></td>
		<td><b>Retour prévu</b></td>
	</tr>

<?
	$borrowingBooks = $this->borrowingBooks;
	
	
	for($i=0; $i < count($borrowingBooks); $i++){

		$title 					= $borrowingBooks[$i]['TITRE'];
		$startborrowingDate 	= $borrowingBooks[$i]['DATE_EMP'];
		$endBorrowingDate 	= $borrowingBooks[$i]['DATE_RETOUR'];

		echo "
				<tr>
					<td>$title</td>
					<td>$startborrowingDate</td>
					<td>$endBorrowingDate</td>
		</tr> ";

	}

?>
	
</table>

</br>
 </div>

 <div class="tab-content">
    <h4>Réservations</h4>               
 </div>

</div>

</section>


</div>

