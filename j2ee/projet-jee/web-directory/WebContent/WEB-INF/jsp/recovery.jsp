<%@ include file="/WEB-INF/jsp/includes/meta.jsp"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>


<html>
<!-- EN-TÊTE DE LA PAGE (Meta-informations) -->
<head>

<style>
.error {
	color: #ff0000;
}

.errorblock {
	color: #000;
	background-color: #ffEEEE;
	border: 3px solid #ff0000;
	padding: 8px;
	margin: 16px;
}
</style>

<%@ include file="includes/stylesheets.jsp"%>
<title>Annuaire web - Accueil</title>
</head>

<!-- CORPS DE LA PAGE -->
<body>
	<!-- HEADER -->
	<%@ include file="includes/header.jsp"%>

	<!-- PANNEAU LATÉRAL -->
	<%@ include file="includes/side_pannel.jsp"%>

	<!-- CONTENU -->
	<div id="contents">

		<h2>Recuperation de votre mot de passe</h2>

		<form:form method="POST" commandName="userService">
			<form:errors path="id" cssClass="errorblock" element="div" />
			<table>
				<tr>
					<td>Entrez votre identifiant:</td>
					<td><form:input path="id"  /></td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" value="Valider"/></td>
				</tr>

			</table>
		</form:form>


	</div>
	<!-- FOOTER -->
	<%@ include file="includes/footer.jsp"%>
</body>
</html>