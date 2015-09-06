
<html>
   <head>
		<title>INSCRIPTION-ADHERENTS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<STYLE TYPE="text/css">
			<!--
			H1 { font-size: 20pt; color: red; }
		 
			
			-->
		</STYLE> 
   </head>
   
   
   <body bgcolor="white">
		<h1>Insription-Adhérents</h1>
       <FORM ACTION="index.php?action=AddMember"  METHOD="post" >
			
		<div align="">
		
			<DIV STYLE="margin-left: 50px; color: blue"> 
			
			SEXE : <input type="radio" name="sexe" value="Masculin" >Masculin
			       <input type="radio" name="sexe" value="Féminin" >Féminin<br /><br />
							  
							  
			NOM :&#160;&#160;&#160; <input type="text" name="nom" value="" SIZE="40"><br /><br />
			PRENOM :&#160;&#160;&#160; <input type="text" name="prenom" value="" SIZE="40"><br /><br />
			DATE DE NAISSANCE :&#160;&#160;&#160; <input type="date" name="date_de_naissance" value="" SIZE="40"><br /><br/> 
			ADRESSE :&#160;&#160;&#160; <input type="text" name="adresse" value="" SIZE="40"><br /><br />
			CODE POSTAL :&#160;&#160;&#160; <input type="text" name="code postal" value="" SIZE="40"><br /><br />
			ADRESSE MAIL :&#160;&#160;&#160; <input type="text" name="email" value="" SIZE="40"><br /><br />
			TELEPHONE : &#160;&#160;&#160;<input type="text" name="Telephone" value="" SIZE="40"><br /><br />
		
                  
			
						
			VILLES :&#160;&#160; <SELECT name="Villes" >
			<option value="Paris">Paris</option>
			<option value="Marseille">Marseille </option>
			<option value="Lyon">Lyon</option>
			<option value="Toulouse">Toulouse</option>
			<option value="Nice">Nice</option>
			<option value="Nantes">Nantes</option>
			<option value="Strasbourg">Strasbourg </option>
			<option value="Montpellier">Montpellier</option>
			<option value="Bordeaux">Bordeaux </option>
			<option value="Lille">Lille</option>
			<option value="Rennes">Rennes</option>
			<option value="Reims">Reims </option>
			<option value="Le Havre">Le Havre</option>
			<option value="St Etienne">St Etienne</option>
			<option value="Toulon">Toulon</option>
			<option value="Grenoble">Grenoble</option>
			<option value="Angers">Angers</option>
			<option value="Dijon">Dijon</option>
			<option value="Brest">Brest</option>
			</SELECT><br /><br />
		
			DATE DE PAIEMENT :&#160;&#160;&#160; <input type="date" name="date" value="" SIZE="45"><br /><br />
			
			<p>
			<input type="submit" value="Envoyer">
			<input type="reset" value="Effacer">
			</p>

		</div>

	   </FORM>
	   
	   
   </body>
</html>
