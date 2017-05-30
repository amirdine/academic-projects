<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>


<html>
  <!-- EN-TÊTE DE LA PAGE (Meta-informations) -->
  <head>
  	<%@ include file="./../includes/stylesheets.jsp" %>
    <title>Annuaire web - Accueil</title>
  </head>
  
  <!-- CORPS DE LA PAGE -->
  <body>
  	<!-- HEADER -->
  	<%@ include file="./../includes/header.jsp" %>
  	 
  	<!-- PANNEAU LATÉRAL -->
  	<%@ include file="./../includes/side_pannel.jsp" %>
    
    <!-- CONTENU -->
    <div id="contents">
    	
    	<h2> Recuperation de votre mot de passe</h2>
    	    
    	    <br/>
    		  <b>Votre met de passe &agrave &eacute;t&eacute; envoy&eacute; &agrave; votre adresse e-mail</b>
    		<ul>
				<li> <a href="./../../home"> Allez &agrave; la page d'accueil </a> </li>
				<li> <a href="login"> Se connecter</a></li>
            </ul>
  		     
    </div> 
    <!-- FOOTER -->
	<%@ include file="./../includes/footer.jsp" %>	    
  </body>
</html>