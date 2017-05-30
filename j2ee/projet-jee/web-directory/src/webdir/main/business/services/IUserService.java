package webdir.main.business.services;

public interface IUserService {
	
   /**
	* Permet l'authentification d'une personne et la récuperation du mot de passe
	* de l'utilisateur.
	* @param login Identifiant de la personne.
	* @param password Mot de passe de l'utilisateur.
	* @return  True si le login et le mot de passe sont correct.
    * @throws Exception 
	*/
    public boolean connect(long login, String password) throws Exception;
    
    
   /**
	* Permet à l'utilisateur de récupérer son mot de passe par e-mail.
	* @param id Indenfiant de l'utilisateur
	* @throws Exception
	*/
	public void sendUserPassword(long id) throws Exception;


}
