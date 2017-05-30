<%@ include file="/WEB-INF/jsp/includes/meta.jsp" %>

<!-- PANNEAU LATÉRAL -->
<div id="side_panel">
	<!-- NAVIGATION -->
    <div id="navigation">
		<ul>
			<c:forEach var="g" items="${groupIterator}">
				<li>
		    		<a href="groups/group/${g.getGroupID()}"
		    		   title="Liste des membres du groupe ${g.getName()}">
		    			${g.getName()}
		    		</a>
		  		</li>	
			</c:forEach>
		</ul>
    </div>
</div>