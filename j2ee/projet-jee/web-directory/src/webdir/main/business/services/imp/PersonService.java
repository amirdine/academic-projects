package webdir.main.business.services.imp;

import java.util.Collection;
import java.util.List;

import javax.annotation.PostConstruct;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import webdir.main.business.dao.IPersonDao;
import webdir.main.business.services.IPersonService;
import webdir.main.model.Person;
import webdir.main.model.User;


/**
 * Service d'acces aux donnes metiers de type Person.
 */
@Component
@Service
public class PersonService implements IPersonService {

	@Autowired
	IPersonDao personDao;
	
	
	public IPersonDao getPersonDao() {
		return personDao;
	}


	public void setPersonDao(IPersonDao personDao) {
		this.personDao = personDao;
	}


	/**
	 * Initialise la connexion a la base de donnes.
	 */
	@PostConstruct
	public void init() {
		personDao.init();
	}
      
	
   /**
	* Retourne la liste de toutes les personnes de l'annuaire.
	* @return Liste de toutes les personnes present dans l'annuaire.
	*/
	public Collection<Person> getAllPersons() {
		List<Person> persons = personDao.getAllPersons();
		return persons;
	}
	
	
   /**
	* @param id Identifiant de la personne
	* @return l'objet Personne.
	*/
	public Person getPerson(long id) throws Exception{	
		return personDao.getPerson(id);
	}

	
   /**
	* Permet de vérifier si un identifiant existe.
	* @param id Identifiant d'une personne.
	* @return true si l'id existe, return flase si l'id n'existe pas.
	*/
	public boolean personIDExists(long id){
		return personDao.personIDExists(id);
	}
	
	
   /**
	* Permet de mette a jour une personne. 
	* @param user utilisateur de l'application
	* @param person objet personne
	* @return False si la mise a jour de la personne echoue.
	*/
	public boolean updatePerson(User user, Person person){
		
		if(new Integer(user.getId()) != person.getId()){
			return false;
		}
		
		if(personDao.personIDExists(person.getId())){
			personDao.updatePerson(person);
			return true;
		}
		
		return false;
	}

	public void close(){
		personDao.close();
	}
	
}