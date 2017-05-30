
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
		<h1>Modification - Adhérent</h1>
			<div id="formulaire">
       <FORM ACTION="index.php?action=SaveUpdateMember"  METHOD="post" >
			
		<div align="">
		
			<DIV STYLE="margin-left: 50px; color: blue"> 
			
		ID ADHÉRENT:&#160;&#160;&#160; </br> <input type="text" name="id_adherent" value="" SIZE="40"  id="id_adherent"> <br/><br/>				  
		NOM :&#160;&#160;&#160;<div id="name"> <input type="text" name="nom" value="" SIZE="40"  id="nom" ></div> <br /><br />
		PRENOM: &#160;&#160;&#160;<div id="prenom"> <input type="text" name="prenom" value="" SIZE="40" class='auto-prenom'></div><br /><br />
	   SEXE: &#160;&#160;&#160;<div id="sexe"> <input type="text" name="sexe" value="" SIZE="40" class='auto-prenom'></div><br /><br />
		DATE NAISSANCE: &#160;&#160;&#160;<div id="date_naissance"> <input type="text" name="date_naissance" value="" SIZE="40"> </div><br /><br />
		ADRESSE:&#160;&#160;&#160; <div id="adresse"> <input type="text" name="adresse" value="" SIZE="45"></div><br /><br />
		VILLE :&#160;&#160;&#160;<div id="ville"> </br><input type="text" name="ville" value="" SIZE="40"></div><br /><br />
		E-MAIL:&#160;&#160;&#160; <div id="email"> <input type="text" name="email" value="" SIZE="45"></div><br /><br />
		TÉLÉPHONE :&#160;&#160;&#160;<div id="telephone"> <input  type="text" name="telephone" value="" SIZE="45"></div><br/>
		
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


function writeInDiv(data){

var id_adherent 	= data[0]['Numero_ADHERENT'];
var nom 			= data[0]['NOM'];
var prenom		 	= data[0]['PRENOM'];
var sexe		 	= data[0]['SEXE'];
var date_naissance 	= data[0]['DATE_NAISSANCE'];
var telephone 		= data[0]['TELEPHONE'];
var e_mail			= data[0]['COURRIEL'];
var adresse       	= data[0]['ADRESSE'];
var ville       	= data[0]['VILLE'];


console.log($("#id_adherent").val() + " -- "+ id_adherent+ " nom " + $("#nom").val());
 
$(document).on( "mousemove", '#formulaire', function() {


	
if(id_adherent == $("#id_adherent").val() && $("#nom").val() == ""){

   

	 $('#name').html("<input type=\"text\" name=\"nom\" value=\""+ nom + " \" SIZE=\"40\" id=\"nom\" >"); 
	 $('#prenom').html("<input type=\"text\" name=\"prenom\" value=\""+ prenom + " \" SIZE=\"40\" class=\"auto-prenom\" >"); 
	 $('#sexe').html("<input type=\"text\" name=\"sexe\" value=\""+ sexe + " \" SIZE=\"40\"  >"); 
     $('#date_naissance').html("<input type=\"text\" name=\"date_naissance\" value=\""+ date_naissance + " \" SIZE=\"40\"  >"); 
	 $('#telephone').html("<input type=\"text\" name=\"telephone\" value=\""+ telephone+ " \" SIZE=\"40\"  >"); 
	 $('#email').html("<input type=\"text\" name=\"e_mail\" value=\""+ e_mail+ " \" SIZE=\"40\"  >");
	 $('#adresse').html("<input type=\"text\" name=\"adresse\" value=\""+ adresse + " \" SIZE=\"40\"  >");
	 $('#ville').html("<input type=\"text\" name=\"ville\" value=\""+ ville + " \" SIZE=\"40\"  >");  
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


$(document).on( "mousemove", '#formulaire', function() {
	

 runServerAction("JsonSearchMember", {
	id_member: $("#id_adherent").val()

 });

 });


</script>
</html>

