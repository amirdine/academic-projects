package webdir.main.model;

import java.util.Date;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

import org.apache.openjpa.persistence.jdbc.ForeignKey;

/**
 * Classe representnant l'objet personne.
 */

@Entity(name = "Person")
public class Person {
	
	@Id
    @GeneratedValue(strategy = GenerationType.AUTO)
	private long   id;
	
	@Column(name = "firstname", length = 25, nullable = false)
	private String firstname;
	
	@Column(name = "lastname", length = 25, nullable = false)
	private String lastname;
	
	@Temporal(TemporalType.DATE)
	@Column(name = "birthdate")
	private Date   birthdate;
	
	@Column(name = "email", length = 100, nullable = false)
	private String email;
	
	@Column(name = "website", length = 100, nullable = true)
	private String website;
	
	@Column(name = "password", length = 25, nullable = false)
	private String password;
	
	 @ManyToOne(cascade=CascadeType.ALL)
	 @JoinColumn(name = "group_id")
	 @ForeignKey 
	 private Group group;
	
	
   /**
    * Retourne l'identifiant de la personne.
    * @return L'identifiant de la personne.
    */
	public long getId() {
		return id;
	}
	
   /**
    * Permet de fixer l'identifiant de la personne.
	* @param id Identifiant de la personne.
	*/
	public void setId(long id) {
		this.id = id;
	}
	
   /**
	* Retourne le prenom de la personne.
	* @return name Le nom de personne
	*/
	public String getFirstname() {
		return firstname;
	}
	
   /**
	* Permet de fixer le prenom de la personne.
	* @param firstname prénom de la personne
	*/
	public void setFirstname(String firstname) {
		this.firstname = firstname;
	}
	
  /**
   * Retourne le nom de famille de la personne.
   * @return le nom de de la personne.
   */
	public String getLastname() {
		return lastname;
	}
	
   /**
    * Permet de fixer le nom de famille de la personne.
	* @param lastname le nom de famille
	*/
	public void setLastname(String lastname) {
		this.lastname = lastname;
	}
	
   /**
    * Retourne la date de naissance de la personne.
    * @return la date de naissance de la personne
	*/
	public Date getBirthdate() {
		return birthdate;
	}
	
   /**
	* Permet de fixer la date de la personne
	* @param birthdate date de la personne.
	*/
	public void setBirthdate(Date birthdate) {
		this.birthdate = birthdate;
	}
	
   /**
	* Retourne l'adresse e-mail de la personne.
	* @return adresse e-mail de la personne.
	*/
	public String getEmail() {
		return email;
	}
	
   /**
	* Permet de fixer l'adresse e-mail de la personne.
	* @param email adresse email de la personne.
	*/
	public void setEmail(String email) {
		this.email = email;
	}
	
   /**
    * Retourne de l'adresse du site web de la personne.
	* @return adresse du site web de la personne.
	*/
	public String getWebsite() {
		return website;
	}
	
   /**
	* Permet de fixer l'url de l'adresse du site web de la personne.
	* @param  website adresse du site web de la personne.
    */
	public void setWebsite(String website) {
		this.website = website;
	}
	
   /**
	* Retourne le mot de passe de la personne.
	* @return le mot de passe de la personne.
	*/
	public String getPassword() {
		return password;
	}
	
   /**
	* Permet de fixer le mot de passe de la personne.
	* @param password mot de passe de la personne.
	*/
	public void setPassword(String password) {
		this.password = password;
	}
	
   /**
    * Retourne le groupe dont appartient la personne.
	* @return groupe
	*/
	public Group getGroup() {
		return group;
	}
	
   /**
	* Permet de fixer le groupe de la personne.
	* @param group groupe.
    */
	public void setGroup(Group group) {
		this.group = group;
	}
	
	public String toString(){
		
		String string = "Person: \n";
		
		string += "- ID: " + this.getId() + "\n";
		string += "- Prénom: " + getFirstname() + "\n";
		string += "- Nom: " + getLastname() + "\n";
		string += "- e-mail: " + getEmail() + "\n";
		string += "- Date de naissance: " + getBirthdate() + "\n";
		string += "- Site web: " + getWebsite () + "\n";
		string += "- Mot de passe: " + getPassword() + "\n";
		string += "- Groupe ID: " + getGroup().getGroupID() + "\n";
		string += "- Nom de groupe: " + getGroup().getName() + "\n";
		
		return string;
	}
	
}