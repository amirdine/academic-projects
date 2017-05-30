<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>

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
       
        
        <c:if test="${not empty user.id}">
    	  <a href="user/logout"> Se deconnecter</a>  &nbsp; &nbsp; &nbsp;
    	   <a href="user/edit"><c:out value="${name}"/></a>
        </c:if>
        
        <c:if test="${empty user.id}">
    	 <a href="user/login"> Se connecter</a>
        </c:if>
    	<h2>Personnes référencées dans l'annuaire</h2>
    
    	<!-- Liste des personnes -->
	    <table>
	    	<tr>
	    		<th>Prénom</th>
	    		<th>Nom</th>
	    		<c:if test="${not empty user.id}">
	    		<th>Web</th>
	    		<th>Affectation</th>
	    		 </c:if>
	    	</tr>
	    	<!-- Listing des personnes -->
	   		<c:forEach var="p" items="${personIterator}">
	   			<tr>
	   				<td><c:out value="${p.getFirstname()}" default="None" /></td>
	   				<td><c:out value="${p.getLastname()}" default="None" /></td>
	   				
	   				 <c:if test="${not empty user.id}">
	   				<td style="text-align: center;">
	   					<a href="https://${p.getWebsite()}" 
	   					   title="Site web de ${p.getFirstname()} ${p.getLastname()}">
	   						<img src="img/world-wide-web-24958_960_720-2.gif" alt="web" />
	   					</a>
	   				</td>
	   				<td><c:out value="${p.getGroup().getName()}" default="None" /></td>
	   				 </c:if>
	   			</tr>
	   		</c:forEach>
	    </table>
	</div>
    
    <!-- FOOTER -->
	<%@ include file="includes/footer.jsp" %>	    
  </body>
</html>