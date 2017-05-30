
<html>
   <head>
		<title>Nouveau Livre</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<STYLE TYPE="text/css">
			<!--
			H1 { font-size: 20pt; color: red; }
		 
			
			-->
		</STYLE> 
   </head>
   
   
   <body bgcolor="white">
		<h1>Nouveau Livre</h1>
			<div id="formulaire">
       <FORM ACTION="index.php?action=AddBook"  METHOD="post" >
			
		<div align="">
		
			<DIV STYLE="margin-left: 50px; color: blue"> 
			
		ISBN :&#160;&#160;&#160; </br> <input type="text" name="isbn" value="" SIZE="40" class='auto-isbn' id="isbn"> <br/><br/>				  
		TITRE :&#160;&#160;&#160;<div id="titre"> <input type="text" name="titre" value="" SIZE="40" class='auto-titre' ></div> <br /><br />
		EDITEUR: &#160;&#160;&#160;<div id="editeur"> <input type="text" name="editeur" value="" SIZE="40" class='auto-editeur'></div><br /><br />
		CODE BARRE :&#160;&#160;&#160;</br> <input type="text" name="code" value="" SIZE="40"><br /><br />
		DATE ACHAT :&#160;&#160;&#160; </br><input type="date" name="date_achat" value="" SIZE="40"><br /><br />
		COTE :&#160;&#160;&#160;<div id="cote"> <input type="text" name="cote" value="" SIZE="40"></div><br /><br />
		NOM AUTEUR :&#160;&#160;&#160; <div id="nom_auteur"> <input type="text" name="nom_auteur" value="" SIZE="45"></div><br /><br />
		PRENON AUTEUR :&#160;&#160;&#160;<div id="prenom_auteur"> <input  type="text" name="prenom_auteur" value="" SIZE="45"></div><br/>
		DATE DE PARUTION:&#160;&#160;&#160;<div id="date_parution"> <input  type="date" name="date_parution" value="" SIZE="45"></div><br/>
	   MOT-CLÉS:&#160;&#160;&#160;<div id="mot-cle"> <input  type="text" name="mot-cle" value="" SIZE="45"></div><br/>
			
			<p>
			<input type="submit" value="Envoyer">
			<input type="reset" value="Effacer">
			</p>

		</div>

	   </FORM>
	   </div>
	   
   </body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>	
<script type="text/javascript">
$(function() {
	
	//autocomplete
	$(".auto-editeur").autocomplete({
		source: "script/php/SearchPublisher.php",
		minLength: 1
	});				

});
</script>
<script type="text/javascript">
$(function() {
	
	//autocomplete
	
	$(".auto-titre").autocomplete({
		source: "script/php/SearchTitle.php",
		minLength: 1
	});				

});

$(function() {
	
	//autocomplete
	
	$(".auto-isbn").autocomplete({
		source: "script/php/SearchISBN.php",
		minLength: 1
	});				

});


function writeInDiv(data){

var isbn 			= data[0]['ISBN'];
var titre 			= data[0]['TITRE'];
var editeur		 	= data[0]['NOM_EDI'];
var cote    	 	= data[0]['COTE'];
var nom_auteur 	= data[0]['NOM_AUTEUR'];
var prenom_auteur = data[0]['PRENOM_AUTEUR'];
var date_parution = data[0]['DATE_PARUTION'];
var mot_cle       = data[0]['MOT_CLES'];

 
$(document).on( "mousemove", '#formulaire', function() {

console.log($("#isbn").val() + " -- "+ isbn);
	
if(isbn == $("#isbn").val()){

   

	 $('#titre').html("<input type=\"text\" name=\"titre\" value=\""+ titre + " \" SIZE=\"40\" class=\"auto-titre\" >"); 
	 $('#editeur').html("<input type=\"text\" name=\"editeur\" value=\""+ editeur + " \" SIZE=\"40\" class=\"auto-editeur\" >"); 
	 $('#cote').html("<input type=\"text\" name=\"cote\" value=\""+ cote + " \" SIZE=\"40\"  >"); 
	 $('#nom_auteur').html("<input type=\"text\" name=\"nom_auteur\" value=\""+ nom_auteur + " \" SIZE=\"40\"  >"); 
	 $('#prenom_auteur').html("<input type=\"text\" name=\"prenom_auteur\" value=\""+ prenom_auteur+ " \" SIZE=\"40\"  >"); 
	 $('#date_parution').html("<input type=\"text\" name=\"date_parution\" value=\""+ date_parution+ " \" SIZE=\"40\"  >");
	 $('#mot-cle').html("<input type=\"text\" name=\"mot-cle\" value=\""+ mot_cle+ " \" SIZE=\"40\"  >");  
}
});



}



function runServerAction(actionName, data) {




$.ajax({ 

  type: "POST",
  url: "index.php?action="+actionName,
  data: data,
  dataType: 'json',
  success: function(data){
       
				writeInDiv(data);
   }

});


}


window.setInterval(function(){
 runServerAction("SearchBook", {
	isbn: $("#isbn").val()

 });

}, 1000);



</script>
</html>

