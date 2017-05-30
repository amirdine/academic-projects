<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>


<html>
  <!-- EN-TÊTE DE LA PAGE (Meta-informations) -->
  <head>
  	<%@ include file="includes/stylesheets.jsp" %>
    <title>Annuaire web - Accueil</title>
  </head>
  
  <!-- CORPS DE LA PAGE -->
  <body>
  	<!-- HEADER -->
  	<%@ include file="includes/header.jsp" %>
  	 
  	<!-- PANNEAU LATÉRAL -->
  	<%@ include file="includes/side_pannel.jsp" %>
    
    <!-- CONTENU -->
    <div id="contents">
    	
    	
    	    
    	    <br/>
    		<b>DECONNEXION </b>
    		
    		<ul>
				<li> <a href="./../home"> Allez &agrave; la page d'accueil </a> </li>
				<li> <a href="login"> Se Connecter</a></li>
            </ul>
  		     
    </div> 
    <!-- FOOTER -->
	<%@ include file="includes/footer.jsp" %>	    
  </body>
</html>