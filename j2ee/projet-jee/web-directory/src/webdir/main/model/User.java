package webdir.main.model;

import java.io.Serializable;

import org.springframework.context.annotation.Scope;
import org.springframework.context.annotation.ScopedProxyMode;
import org.springframework.stereotype.Component;


/**
 * Classe representant l'utilisateur de l'application.
 */

@Component()
@Scope(value = "session", proxyMode = ScopedProxyMode.TARGET_CLASS)
public class User implements Serializable {

    private static final long serialVersionUID = 1L;

    private String id;
    private String password;
    
    
   
  /**
   * Retourne l' ID de  l'utilisateur
   * @return id ID de l'utilisateur
   */
   public String getId() {
		return id;
   }

   /**
	* Permet de fixer l'ID de l'utilisateur 
	* @param i ID de l'utilisateur
	*/ 
	public void setId(String i) {
		this.id = i;
	}

   /**
    * Retourne le login de  l'utilisateur
    * @return login login de l'utilisateur
    */
	
	
   /**
	* Retourne le mot de passe de l'utilisateur
	* @return
	*/
	public String getPassword() {
		return password;
	}
	
   /**
	* Permet de fixer le mot de passe de l'utilisateur 
	* @param password Mot de passe de l'utilisateur
	*/
	public void setPassword(String password) {
		this.password = password;
	}
    
	public String toString(){
		
		String string = "\n User: \n";
		
		string += " Id: " + getId();
		string += "\n Password:" + getPassword();
		
		return string;
	}
    
}