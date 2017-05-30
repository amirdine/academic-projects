package webdir.main.business.services;

import javax.mail.MessagingException;

public interface IEmailService {
	

   /**
	* Permet d'envoyer un e-mail.
	* @param recipient adresse e-mail du destinatire.
	* @param subject sujet de l'e-mail.
	* @param content contenu de l'e-mail (Texte).
	*/
	public void sendEmail(String recipient, String subject, String content) 
			throws MessagingException;
	
	public void init();

}
