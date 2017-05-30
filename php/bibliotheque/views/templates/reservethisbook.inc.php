
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
		<h1>Reservation</h1>
			<div id="formulaire" style="width:50%">
       <FORM ACTION="index.php?action=SaveReservationBook"  METHOD="post" >
			
			
		ID ADHÉRENT :&#160;&#160;&#160; </br> <input type="text" name="id_adherent" value="" SIZE="40" class='auto-isbn' id="isbn"> 
		<br/><br/>				  
		COTE DU LIVRE:&#160;&#160;&#160;<div id="titre"> <input type="text" name="cote" value="" SIZE="40" class='auto-titre' ></div> 
		<br/><br />
	
			<p>
			<input type="submit" value="Envoyer"  class="blue-button">
			<input type="reset" value="Effacer"  class="blue-button">
			</p>



	   </FORM>
	   </div>

		 <div STYLE="position:absolute; top:2.5%; left:40%;">
		     <h1>Liste des réservations</h1> 

				</br>
				<table border="1" bordercolor="black" style="background-color:#FFFFFF" width="100%" cellpadding="5" cellspacing="0">

				<tr>
				<th style="  word-break: break-all;"> Numéro Adhérent</th>
				<th style="  word-break: break-all; "> Nom</th>
				<th style="  word-break: break-all;"> Prénom </th>
				<th style="  word-break: break-all;"> Titre </th>
				<th style="  word-break: break-all; "> Cote </th>
				<th style="  word-break: break-all;"> Date réservation </th>
				<th style="  word-break: break-all;"> Date limite</th>
				</tr>

				<?

				$reservationList = $this->reservationList;


				for($i= 0; $i<count($reservationList); $i++){


				$id_member  		 = $reservationList[$i]['NUMERO_ADHERENT'];	
				$familyName 		 = $reservationList[$i]['NOM'];
   			$firstName  		 = $reservationList[$i]['PRENOM'];
				$title      		 = $reservationList[$i]['TITRE'];	
				$cote       		 = $reservationList[$i]['COTE'];
   			$date_reservation  = $reservationList[$i]['DATE_RESERVATION'];
				$date_limit        = $reservationList[$i]['DATE_LIM'];

				echo "


				<tr>
				<td style=\"  word-break: break-all;\">$id_member</td>
				<td style=\"  word-break: break-all; \">$familyName</td>
				<td style=\"  word-break: break-all;\">$firstName</td>
				<td style=\"  word-break: break-all;\">$title</td>
				<td style=\"  word-break: break-all; \">$cote</td>
				<td style=\"  word-break: break-all;\">$date_reservation </td>
				<td style=\"  word-break: break-all;\">$date_limit</td>
				</tr>
				</table>
				";


}

				
     		
			 ?>
	</table>
	<div>
		
	   
   </body>

</html>

