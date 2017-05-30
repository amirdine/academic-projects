package webdir.main.business.dao;

import java.util.Collection;
import java.util.List;

import webdir.main.model.Group;
import webdir.main.model.Person;

public interface IGroupDao {
	
	  
	  /**
	   * Initialise la connexion (fabrication de l'entitymanger et de la Factory).
	   */
	   public void init();
		   
	  
	  /**
		* Retourne tous les Groupes present dans la base de donnees.
		* SELECT * FROM Group_;
		*/
		public List<Group> getAllGroups();
		
		
	   /**
		* Retourne la liste des personnes contenu dans un groupe.
		* @param id numero identifiant du groupe
		* @return Une liste de personnes
		*/
		public Collection<Person> getContentGroup(long id);
		
		public Group getGroup(long id);
		
		/**
		* Permet de vérifier si l'id d'un groupe existe dans la base de donnees.
		* @param id identifiant de la personne.
	    * @return True ou False.
	    */
		public boolean groupIdExists(long id);	
		
	   /**
		* Ferme l'entity manager
		*/
		public void close();
}