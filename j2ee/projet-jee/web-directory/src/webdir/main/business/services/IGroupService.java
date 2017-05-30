package webdir.main.business.services;

import java.util.Collection;

import webdir.main.model.Group;
import webdir.main.model.Person;

public interface IGroupService {
	
	public void init();
	
   /**
    * Retourne l'objet Group correspondant a l'ID passe en parametre
 	* @param id Identifiant du groupe.
 	* @return l'objet Group.
 	*/
	public Group getGroup(long id);
	
   /**
    * Retourne la liste de toutes les groupes.
    * @return Liste de toutes les groupes present dans l'annuaire.
    */
	public Collection<Group> getAllGroups();
	
	
   /**
 	* Retourne les personnes contenu dans une groupe.
 	* @return Les personnes appartenant au groupe.
    */
	public Collection<Person> getGroupContent(long id);
	
  /** 
   * Permet de vérifier si un identifiant existe.
   * @param id Identifiant d'un groupe.
   * @return true si l'id existe, return flase si l'id n'existe pas.
   */
	public boolean groupIDExists(long id);
	
	
	public void close();
	
}