package webdir.main.business.dao.imp;

import java.util.Collection;
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

import webdir.main.business.dao.IGroupDao;
import webdir.main.model.Group;
import webdir.main.model.Person;


@Service
@Transactional
public class GroupDao implements IGroupDao {

    @Autowired
    @PersistenceContext(unitName = "myData")
    private EntityManager em;
    
    private EntityManagerFactory factory = null;

    @PostConstruct
    public void init() {
	      factory = Persistence.createEntityManagerFactory("myData");
	      em = factory.createEntityManager();
	}

   /**
    * Permet d'ajouter un Groupe dans la base de donnees.
    */
	public void addGroup(Group g) {
		
		 try {
      
	       em.getTransaction().begin();
	       em.persist(g);
	       em.getTransaction().commit();
	      
		 } finally {
		      if (em != null) {
			         em.close();
		      }
		 }
	}


   /**
	* Retourne tous les Groupes present dans la base de donnees.
	* SELECT * FROM Group_;
	*/
	public List<Group> getAllGroups() {
		
		 return em.createQuery("Select g From Group_ g", Group.class).
		            getResultList();	
	}

	
	public Group getGroup(long id) {

	   return em.createQuery("Select g From Group_ g where g.groupID=:arg", Group.class)
			   .setParameter("arg", id).getSingleResult();
	}
	
   /**
	* Retourne la liste des personnes contenu dans un groupe.
	* @param id numero identifiant du groupe
	* @return Une liste de personnes
	*/
	public Collection<Person> getContentGroup(long id){
		
		return em.createQuery("Select p From Person p where p.group.groupID=:arg", Person.class)
		.setParameter("arg", id).getResultList();	
	}
	
	
   /**
	* Permet de vérifier si l'id d'un groupe existe dans la base de donnees.
	* @param id identifiant de la personne.
    * @return True ou False.
    */
	public boolean groupIdExists(long id){
		
		em = factory.createEntityManager();
		Query query = em.createQuery("Select g From Group_ g where g.groupID=:arg", Group.class);
	    query.setParameter("arg", id);
	    
	    if(query.getResultList().size() == 0){
	    	return false;
	    } 
	    return true;	
	}
	
	public void close(){
		em.clear();
	}
	
}