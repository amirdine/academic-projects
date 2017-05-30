

package webdir.main.business.services.imp;

import java.util.Collection;
import java.util.List;

import javax.annotation.PostConstruct;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import webdir.main.business.dao.IGroupDao;
import webdir.main.business.services.IGroupService;
import webdir.main.model.Group;
import webdir.main.model.Person;



/**
 * Service d'acces aux donnes metiers de type Group.
 */
@Component
@Service
public class GroupService implements IGroupService{
	
	@Autowired
	IGroupDao groupDao;
	
	
   /**
	* Initialise la connexion a la base de donnes.
    */
	@PostConstruct
	public void init() {
		groupDao.init();
	}

	/**
     * Retourne la liste de toutes les groupes.
     * @return Liste de toutes les groupes present dans l'annuaire.
     */
     public Collection<Group> getAllGroups() {
			List<Group> groups = groupDao.getAllGroups();
			return groups;
	  }
     
   /**
 	* @param id Identifiant du groupe.
 	* @return l'objet Group.
 	*/
 	public Group getGroup(long id){	
 		return groupDao.getGroup(id);
 	}
 	
   /**
 	* Retourne les personnes contenu dans une groupe.
 	* @return Les personnes appartenant au groupe.
 	*/
 	public Collection<Person> getGroupContent(long id){
 		return groupDao.getContentGroup(id);
 	}
	
 	   /**
 		* Permet de vérifier si un identifiant existe.
 		* @param id Identifiant d'un groupe.
 		* @return true si l'id existe, return flase si l'id n'existe pas.
 		*/
 		public boolean groupIDExists(long id){
 			return groupDao.groupIdExists(id);
 		}
	
 		public void close(){
 			groupDao.close();
 		}
}
