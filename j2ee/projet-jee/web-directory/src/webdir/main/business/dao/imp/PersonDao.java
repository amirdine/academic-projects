package webdir.main.business.dao.imp;

import java.util.List;

import javax.annotation.PostConstruct;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.persistence.PersistenceContext;
import javax.persistence.Query;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import webdir.main.business.dao.IPersonDao;
import webdir.main.model.Group;
import webdir.main.model.Person;



@Service
@Transactional
public class PersonDao implements IPersonDao {

    
    @PersistenceContext(unitName = "myData")
    @Autowired
    private EntityManager em;
    
    private EntityManagerFactory factory = null;

    @PostConstruct
    public void init() {
	      factory = Persistence.createEntityManagerFactory("myData");
	}

    
   /**
    * Permet d'ajouter une personne dans la base de donnees.
    * Insert ....
    */
	public void addPerson(Person p) {
		
		 try {
      
           em = factory.createEntityManager();
	       em.getTransaction().begin();
	       em.persist(p);
	       em.getTransaction().commit();
	      
		 } finally {
		      if (em != null) {
			         em.close();
		      }
		 }
	}


   /**
	* Retourne toutes les personnes present dans la base de donnees.
	* SELECT * FROM Person;
	*/
	public List<Person> getAllPersons() {
		
		em = factory.createEntityManager();
		 return em.createQuery("Select p From Person p", Person.class).
		            getResultList();	
	}

	
   /**
	* Retourne l'objet Person  dont l'ID correspond à l'ID passe en parametre
	* @param id numero identifiant d'une personne.
	* @return Objet Person correspondant à l'ID passe en parametre
	*/
	public Person getPerson(long id) throws Exception {

	   em = factory.createEntityManager();
	   Query query = em.createQuery("Select p From Person p where p.id=:arg", Person.class);
	   query.setParameter("arg", id);
	   return (Person) query.getSingleResult();
	}

	
   /**
	* Permet de vérifier si l'id d'une personne existe dans la base de donnees.
	* @param id identifiant de la personne.
    * @return True ou False.
    */
	public boolean personIDExists(long id){
		
		em = factory.createEntityManager();
		Query query = em.createQuery("Select p From Person p where p.id=:arg", Person.class);
	    query.setParameter("arg", id);
	    
	    if(query.getResultList().size() == 0){
	    	return false;
	    }
	    
	    return true;	
	}

		
   /**
	* Permet de modifier une ou pluieurs donnees contenues dans un tuple de table Person
	*/
	public void updatePerson(Person person){
		
		Person personDao = em.find(Person.class, person.getId());
		em.getTransaction().begin();
		
		personDao.setFirstname(person.getFirstname());
		personDao.setLastname(person.getLastname());
		personDao.setBirthdate(person.getBirthdate());
		personDao.setEmail(person.getEmail());
		
		System.out.println("website:" + person.getWebsite());
		
		if(person.getWebsite() != null ){
			personDao.setWebsite(person.getWebsite());
		}
		
		if( person.getGroup() != null){
			Group  group = new Group();
			group.setGroupID(person.getGroup().getGroupID());
			group.setName(person.getGroup().getName());
			personDao.setGroup(group);
		}
		
		em.getTransaction().commit();
	}

   /**
	* Fermeture de l'entityManager
	*/
	public void close() {
		em.close();
	}
	
	
}