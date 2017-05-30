<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>


<html>
  <!-- EN-TÊTE DE LA PAGE (Meta-informations) -->
  <head>
  
  <style>
  .error {
    color: #ff0000;
}
.errorblock{
    color: #000;
    background-color: #ffEEEE;
    border: 3px solid #ff0000;
    padding:8px;
    margin:16px;
}
  </style>
  
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
    	
    	<h2> Edition de votre profil </h2>
    		
    	
    	<form:form method="POST" commandName="person">
    <form:errors path="*" cssClass="errorblock" element="div"/>
    <table>
    <tr>
        <td>Prénom: </td>
        <td><form:input path="firstname" value="${firstname}" /></td>
    </tr>
    <tr>
        <td>Nom : </td>
        <td><form:input path="lastname" value="${lastname}"  /></td>
    </tr>
     <tr>
        <td>Email : </td>
        <td><form:input path="email" value="${email}" /></td>
    </tr>
    
    <tr>
        <td>Date : </td>
        <td><form:input path="" name="date" value="${birthdate}" /></td>
    </tr>
    
    <tr>
    <td>Groupe: </td>
    <td>
        <form:select path="" name="group_" multiple="false">
            <form:option value="" label="--- Select ---" />
            <form:options items="${groups}" />
        </form:select>
    </td>
  </tr>
    
    <tr>
        <td colspan="3"><input type="submit" /></td>
    </tr>
    
    
    </table>
</form:form>
    	
    	
    	
    	
    	
    	
    	
    </div> 
    <!-- FOOTER -->
	<%@ include file="includes/footer.jsp" %>	    
  </body>
</html>