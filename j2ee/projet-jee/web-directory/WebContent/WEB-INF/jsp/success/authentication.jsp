<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>


<html>
  <!-- EN-T�TE DE LA PAGE (Meta-informations) -->
  <head>
  	<%@ include file="./../includes/stylesheets.jsp" %>
    <title>Annuaire web - Accueil</title>
  </head>
  
  <!-- CORPS DE LA PAGE -->
  <body>
  	<!-- HEADER -->
  	<%@ include file="./../includes/header.jsp" %>
  	 
  	<!-- PANNEAU LAT�RAL -->
  	<%@ include file="./../includes/side_pannel.jsp" %>
    
    <!-- CONTENU -->
    <div id="contents">
    	
    	<h2> Authentification </h2>
    	    
    	    <br/>
    		<b> Vous �tes conneter en tant que <c:out value="${name}"/> </b>
    		
    		<ul>
				<li> <a href="./../home"> Allez &agrave; la page d'accueil </a> </li>
				<li> <a href="edit"> Editer son profil</a> </li>
				<li> <a href="logout"> Se d&eacute;connecter</a></li>
            </ul>
  		     
    </div> 
    <!-- FOOTER -->
	<%@ include file="./../includes/footer.jsp" %>	    
  </body>
</html>