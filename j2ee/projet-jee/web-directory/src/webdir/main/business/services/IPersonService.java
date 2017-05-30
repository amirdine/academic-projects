package webdir.main.business.services;

import java.util.Collection;

import webdir.main.model.Person;
import webdir.main.model.User;

public interface IPersonService {

	public void init();
	
   /**
	* Retourne la liste de toutes les personnes de l'annuaire.
	* @return Liste de toutes les personnes present dans l'annuaire.
	*/
	public Collection<Person> getAllPersons();
	
   /**
    * Retourne l'objet Person correspondant a l'ID passe en parametre
    * @param id Identifiant de la personne
    * @return l'objet Personne.
    */
	public Person getPerson(long id) throws Exception;
	
   /**
    * Permet de vérifier si un identifiant existe.
    * @param id Identifiant d'une personne.
    * @return true si l'id existe, return flase si l'id n'existe pas.
	*/
	public boolean personIDExists(long id);	
	
	public void close();
	
	public boolean updatePerson(User user, Person person);
}
