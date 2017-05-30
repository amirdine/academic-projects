
<div>
<div class="barre2">
<ul id="menuAdmin">
<li><a href="#">Paramètres</a></li>
<li><a href="index.php?action=ManageMember">Adhérents</a></li>
<li><a href="index.php?action=ManageBook">Livres</a></li>
<li><a onclick="window.open('index.php?action=GiveBackBook');">Retour</a></li>
<li><a onclick="window.open('index.php?action=BorrowBook');">Emprunt</a></li>
<li><a onclick="window.open('index.php?action=ReserveThisBook');">Réservation</a></li>
</ul>
</div>

<div id="recherche">
<b>Recherche</b></br>
<form action="index.php?action=SearchMember" method="post" >
 <input type="text" name="argument"> <input  class="blue-button" type="submit" value="Valider">
</br>
<input type="radio" name="search_member" value="id" checked> Identifiant
<input type="radio" name="search_member" value="nom"> Nom
</div>
</form>



<div id="option">
<b>Options</b></br>
</br>
<a class="blue-button" onclick="window.open('index.php?action=UpdateMember');" ><font color="white">Modifier</font></a>
<a  class="blue-button" onclick="window.open('index.php?action=RegisterMember'); "><font color="white">Nouveau</font></a>
</div>



<form action="index.php?action=ManageSelectMember" method="post" name="hiddenform" >
<INPUT type="hidden"  name="pageid"> 
<div id="navcontainer"  class="elevator">
<ul id="navlist">

<table border="1" bordercolor="#FFFFFF" style="background-color:#00BFFF" width="100%" cellpadding="0" cellspacing="1">
	<tr>
		<td style="width:12px;  word-break: break-all ;color:#fff; font-weight:bold;" >ID</td>
		<td style="width:30px;  word-break: break-all;color:#fff; font-weight:bold;">Nom</td>
		<td style="width:25px;  word-break: break-all ;color:#fff; font-weight:bold;" >Prénom</td>
	</tr>
</table>


<? 

$members = $this->members->getMembers();

if($members!= NULL){
for($i= 0; $i<count($members); $i++){


	$id       = $members[$i]->getId();	
	$name     = $members[$i]->getFamillyName();
	$fistName = $members[$i]->getFirstName();

	echo "

	<li>
	<a href=\"#\" onclick=\"goto($id); return false;\">
		<table border=\"1\" bordercolor=\"#CCCCCC\" style=\"background-color:#FFFFFF\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td style=\"width:10px;  word-break: break-all;\">$id </td>
				<td style=\"width:25px;  word-break: break-all; \">$name</td>
				<td style=\"width:25px;  word-break: break-all;\">$fistName</td>
			</tr>
		</table>
	</a>
</li>";


}
}

$id = $this->selectMember; 
$selectMember = $this->members->getMember($id);

if(!$selectMember && $id != NULL){
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
				<td> <b><font color="white">Adhérent n° <? echo $this->selectMember  ?></font></b> </td> 
			</tr>
		</table>
	</br>

	<b>Nom:</b> <? if($selectMember != null){ echo $selectMember->getFamillyName(); }?> &nbsp; &nbsp; &nbsp; &nbsp; 
   <b>Prénom:</b> <? if($selectMember != null){echo $selectMember->getFirstName(); }?>  &nbsp; &nbsp; &nbsp; &nbsp;</br></br>
	<b>Date de naissance:</b>  <? if($selectMember != null){echo $selectMember->getDateOfBirth(); }?> 
	</br></br>
 </div>

	
 <div class="tab-content">
 
	<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
	<tr> <td> <b><font color="#fff">Coordonnées</font></b> </td> </tr>
	</table>

</br>
<b>Adresse:</b> <? if($selectMember != null){echo $selectMember->getAddress(); }?>  &nbsp; &nbsp; &nbsp; &nbsp;
<b> Code Postal:</b> 14870 &nbsp; &nbsp; &nbsp; &nbsp; </br> </br><b>Ville:</b> <? echo $selectMember->getCity(); ?> 

</br></br>
<b>courriel:</b> <? if($selectMember != null){echo $selectMember->getEmail(); }?>    &nbsp; &nbsp; &nbsp; &nbsp; <b>Tél:</b> <? echo $selectMember->getPhoneNumber(); ?> 
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
</div>

