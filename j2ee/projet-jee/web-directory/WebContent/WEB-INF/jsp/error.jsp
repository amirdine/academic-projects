<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>

<html>
	<!-- EN-TÊTE DE LA PAGE (Meta-informations) -->
	<head>
		<%@ include file="includes/stylesheets.jsp" %>
		<title>Annuaire web - Erreur</title>
	</head>
	
	<!-- CORPS DE LA PAGE -->
	<body>
		<!-- HEADER -->
		<%@ include file="includes/header.jsp" %>

		<!-- PANNEAU LATÉRAL -->
		<%@ include file="includes/side_pannel.jsp" %>
   
   		<!-- CONTENU -->
		<div id="contents">
    		<h2>/!\ Oups... Une erreur est survenue</h2>
    		<p>${errMsg}</p>
    		<p>Si le problème persiste, veuillez en informer l'administrateur de ce site.</p>
		</div>
   
   		<!-- FOOTER -->
		<%@ include file="includes/footer.jsp" %>	    
	</body>
</html>