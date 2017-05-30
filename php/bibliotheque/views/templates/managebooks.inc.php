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
<form action="index.php?action=SearchBookOption" method="post" >
 <input type="text" name="argument" > <input  class="blue-button" type="submit" value="Valider">
</br></br>
<input type="radio" name="search_book" value="titre" checked> Titre
<input type="radio" name="search_book" value="auteur"> Auteur
<input type="radio" name="search_book" value="mot-cle"> Mot-clés
</div>
</form>



<div id="option">
<b>Options</b></br>
</br>
<a class="blue-button" onclick="window.open('index.php?action=RegisterBook'); "><font color="white">Nouveau</font></a>
<a class="blue-button" onclick="window.open('index.php?action=Print'); "><font color="white">Retard</font></a>
</div>



<form action="index.php?action=SelectBook" method="post" name="hiddenform" >
<INPUT type="hidden"  name="pageid"> 
<div id="navcontainer"  class="elevator">
<ul id="navlist">

<table border="1" bordercolor="#FFFFFF" style="background-color:#00BFFF" width="100%" cellpadding="0" cellspacing="1">
	<tr>
		<td style="width:12px;  word-break: break-all ;color:#fff; font-weight:bold;" >Code</td>
		<td style="width:34px;  word-break: break-all;color:#fff; font-weight:bold;">Titre</td>
		<td style="width:25px;  word-break: break-all ;color:#fff; font-weight:bold;" >Auteur</td>
	</tr>
</table>


<? 

$books = $this->books->getBooks();

if($books != NULL){

for($i= 0; $i<count($books); $i++){


	$id         = $books[$i]->getNumber();	
	$name       = $books[$i]->getTitle();
	$familyName = $books[$i]->getFamilyNameOfAuthor();
   $firstName  = $books[$i]->getFirstNameOfAuthor();

	echo "

	<li>
	<a href=\"#\" onclick=\"goto($id); return false;\">
		<table border=\"1\" bordercolor=\"#CCCCCC\" style=\"background-color:#FFFFFF\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td style=\"width:2%;  word-break: break-all;\">$id </td>
				<td style=\"width:5.25%;  word-break: break-all; \">$name</td>
				<td style=\"width:5%;  word-break: break-all;\">$firstName  $familyName</td>
			</tr>
		</table>
	</a>
</li>";


}

}
$id = $this->selectBook; 

$selectBook = $this->books->getBook($id);

if(!$selectBook && $id != NULL ){
	$id       	  = $books[0]->getCode();
	$selectBook = $this->books->getBook($id);
}

?>

		</ul>
	</div>
</form>



<div id="fiche">
 

	<section id="wrapper" class="wrapper">

 
	<div id="v-nav">
		<ul>
    		<li tab="tab1" class="first current">Livres</li>
    		<li tab="tab2">Informations</li>
    		<li tab="tab3">Prêts</li>
    		<li tab="tab4" class="last">Historique</li>
 	</ul>

 	<div class="tab-content">
 		
		<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
			<tr> 
				<td> <b><font color="white">Livre n° <? if($selectBook != null){echo $selectBook->getNumber();} ?></font></b> </td> 
			</tr>
		</table>
	</br>

	<b>Titre:</b> <? if($selectBook != null){echo $selectBook->getTitle(); }?> &nbsp; &nbsp; &nbsp; &nbsp; </br></br>
   <b>Auteur:</b> <? if($selectBook != null){echo $selectBook->getFamilyNameOfAuthor(); ?>  &nbsp; <? echo $selectBook->getFirstNameOfAuthor(); }?> 
	</br></br>
	<b>Disponibilité:</b> <? if($selectBook != null){echo $selectBook->getAvailability(); }?> 
 </div>

	
 <div class="tab-content">
 
	<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
	<tr> <td> <b><font color="#fff">Informations</font></b> </td> </tr>
	</table>

</br>
<b>ISBN:</b> <? if($selectBook != null){echo $selectBook->getISBN(); }?>  &nbsp; &nbsp; &nbsp; &nbsp; </br></br>
<b> Date d'Achat:</b>  <?if($selectBook != null){echo $selectBook->getPurchaseDate();}?> 

</br></br>
<b>Cote:</b> <? if($selectBook != null){echo $selectBook->getRareBookShelf(); }?>    &nbsp; &nbsp; &nbsp; &nbsp; </br></br>
<b>Date de parution :</b> <?if($selectBook != null){ echo $selectBook->getPublicationDate();} ?> </br></br>
<b>Code Barre :</b> <? if($selectBook != null){echo $selectBook->getCode(); }?> </br>
</br>
		

 </div>


 <div class="tab-content">
    <table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
<tr> <td> <b><font color="#fff">Prêts</font></b> </td> </tr>
</table>
</br>
<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="100%" cellpadding="3" cellspacing="0">
	<tr>
		<td><b>Titre</b></td>
		<td><b>Date du Prêt</b></td>
		<td><b>Retour prévu</b></td>
	</tr>

<?
	$borrowingByBook = $this->borrowingByBook ;
	

	

		$title   				= $borrowingByBook[5];
		$startborrowingDate 	= $borrowingByBook[2];
		$endBorrowingDate  	= $borrowingByBook[3];

		echo "
				<tr>
					<td>$title</td>
					<td>$startborrowingDate</td>
					<td>$endBorrowingDate</td>
		</tr> ";


?>	
</table>

</br>
 </div>

 <div class="tab-content">
      <table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
			<tr> <td> <b><font color="#fff">Historique</font></b> </td> </tr>
</table>
</br>
<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="100%" cellpadding="3" cellspacing="0">
	<?
		$historyByBook = $this->historyByBook;
	
	?>	

	<tr>
		<td><b>Nom</b></td>
		<td><b>Prénom</b></td>
		<td><b>Date du Prêt</b></td>
		<td><b>Retour prévu</b></td>
	</tr>	
	
	<?
		for($i=0; $i < count($historyByBook); $i++) {
					
     	$nom   				   = $historyByBook[$i]['NOM'];
		$prenom   				= $historyByBook[$i]['PRENOM'];
		$startborrowingDate 	= $historyByBook[$i]['DATE_EMP'];
		$endBorrowingDate  	= $historyByBook[$i]['DATE_RETOUR'];

		echo "   <tr>
					<td>$nom</td>
					<td>$prenom</td>
					<td>$startborrowingDate</td>
					<td>$endBorrowingDate</td>
					</tr>
			";
    	}
	?>	
   </table>         
 </div>

</div>

</section>


</div>

