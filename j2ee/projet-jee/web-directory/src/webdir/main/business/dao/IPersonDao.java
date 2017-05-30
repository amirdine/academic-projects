package webdir.main.business.dao;

import java.util.List;

import webdir.main.model.Person;

public interface IPersonDao {

   /**
	* Permet d'ajouter une personne dans la base de donnees.
	* Insert ....
	*/
	public void addPerson(Person person);
	
   /**
    * Retourne toutes les personnes present dans la base de donnees.
    * SELECT * FROM Person;
    */
	public Person getPerson(long id) throws Exception;
	
	
   /**
    * Retourne l'objet Person  dont l'ID correspond à l'ID passe en parametre
    * @param id numero identifiant d'une personne.
    * @return Objet Person correspondant à l'ID passe en parametre
	*/
	public List<Person> getAllPersons();
	
   /**
    *  Instaciation de la factory
    */
	public void init();

   /**
	* Permet de vérifier si l'id d'une personne existe dans la base de donnees.
	* @param id identifiant de la personne.
    * @return True ou False.
    */
	public boolean personIDExists(long id);

	
   /**
    * Permet de modifier une ou pluieurs donnees contenues dans un tuple de table Person
    * @param person Objet Personne
    */
	public void updatePerson(Person person);

	
   /**
	* Fermeture de l'entityManager
	*/
	public void close();
}
