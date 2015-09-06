<div class="barre2">
<ul id="menuAdmin">
<li><a href="index.php?action=LoginForm">MySpace</a></li>
<li><a href="index.php?action=Search">Livres</a></li>
</ul>
</div>

<div id="recherche">
<b>Recherche</b></br>
<form action="index.php?action=MySearchBookOption" method="post" >
 <input type="text" name="argument"> <input  class="blue-button" type="submit" value="Valider">
</br></br>
<input type="radio" name="search_book" value="titre" checked> Titre
<input type="radio" name="search_book" value="auteur"> Auteur
<input type="radio" name="search_book" value="mot-cle"> Mot-clés
</div>
</form>




<form action="index.php?action=MySelectBook" method="post" name="hiddenform" >
<INPUT type="hidden"  name="pageid"> 
<div id="navcontainer"  class="elevator">
<ul id="navlist">

<table border="1" bordercolor="#FFFFFF" style="background-color:#00BFFF" width="100%" cellpadding="0" cellspacing="1">
	<tr>
		<td style="width:12px;  word-break: break-all ;color:#fff; font-weight:bold;" >Code</td>
		<td style="width:30px;  word-break: break-all;color:#fff; font-weight:bold;">Titre</td>
		<td style="width:25px;  word-break: break-all ;color:#fff; font-weight:bold;" >Auteur</td>
	</tr>
</table>


<? 

$books = $this->books->getBooks();

if($books == NULL ) return false;

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
				<td style=\"width:10px;  word-break: break-all;\">$id </td>
				<td style=\"width:25px;  word-break: break-all; \">$name</td>
				<td style=\"width:25px;  word-break: break-all;\">$firstName  $familyName</td>
			</tr>
		</table>
	</a>
</li>";


}


$id = $this->selectBook; 

$selectBook = $this->books->getBook($id);

if($selectBook == NULL) return false;

if(!$selectBook){
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

 	</ul>

 	<div class="tab-content">
 		
		<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
			<tr> 
				<td> <b><font color="#fff">Livre n° <? echo $selectBook->getNumber() ?></font></b> </td> 
			</tr>
		</table>
	</br>

	<b>Titre:</b> <? echo $selectBook->getTitle(); ?> &nbsp; &nbsp; &nbsp; &nbsp; </br></br>
   <b>Auteur:</b> <? echo $selectBook->getFamilyNameOfAuthor(); ?>  &nbsp; <? echo $selectBook->getFirstNameOfAuthor(); ?> 
	</br></br>
	<b>Disponibilité:</b> <? echo $selectBook->getAvailability(); ?> 
 </div>

	
 <div class="tab-content">
 
	<table border="0"  style="background-color:#00BFFF" width="100%" cellpadding="3" cellspacing="1">
	<tr> <td> <b><font color="#fff">Informations</font></b> </td> </tr>
	</table>

</br>
<b>ISBN:</b> <? echo $selectBook->getISBN(); ?>  &nbsp; &nbsp; &nbsp; &nbsp; </br></br>
<b> Date d'Achat:</b>  <?echo $selectBook->getPurchaseDate();?> 

</br></br>
<b>Cote:</b> <? echo $selectBook->getRareBookShelf(); ?>    &nbsp; &nbsp; &nbsp; &nbsp; </br></br>
<b>Date de parution :</b> <? echo $selectBook->getPublicationDate(); ?> </br></br>
<b>Code Barre :</b> <? echo $selectBook->getCode(); ?> </br>
</br>
		

 </div>





</div>

</section>


</div>

