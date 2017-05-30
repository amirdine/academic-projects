package webdir.main.business.services.imp;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import webdir.main.business.dao.IPersonDao;
import webdir.main.business.services.IEmailService;
import webdir.main.business.services.IUserService;
import webdir.main.model.Person;

/**
 * Classe pour l'authentificaion.
*/
@Component
@Service
public class UserService implements IUserService {
	
	@Autowired
	IPersonDao personDao;
	
	@Autowired
	IEmailService emailService;
	
    
	private int id;
	
    public int getId() {
		return id;
	}


	public void setId(int id) {
		this.id = id;
	}


	private Person person;
	
   /**
    * Permet l'authentification d'une personne.
    * @param login - Identifiant de la personne.
    * @param password - Mot de passe.
    * @return  True si le login et le mot de passe sont correct.
    */
	public boolean connect(long login, String password) throws Exception{
		
		if( personDao.personIDExists(login)){
			
			person = personDao.getPerson(login);
			
			if(person.getPassword().contentEquals(password)){
				return true;
			}	
		}
		return false;
	}
	
	
   /**
	* Permet à l'utilisateur de récupérer son mot de passe par e-mail.
	* @param id Indenfiant de l'utilisateur
	* @throws Exception
	*/
	public void sendUserPassword(long id) throws Exception{
		
		Person person = personDao.getPerson(id);
		String password = person.getPassword();
		
	
		String recipient = person.getEmail();
		String subject = "Récupération de votre mot de passe";
		String content = "Bonjour, \n\n Votre mot de passe est: " + password + "\n\n "
						+ "L'Equipe Secu Webdirectory";
		
		emailService.sendEmail(recipient, subject, content);
	}

}
