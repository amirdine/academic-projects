package webdir.main.business.services.imp;

import java.util.Properties;

import javax.annotation.PostConstruct;
import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import webdir.main.business.services.IEmailService;


@Component
@Service
public class EmailService implements IEmailService {
	
	private  String username;
	private  String password;
	private  Properties prop;
	private  Session session;
	
	
	public void setProp(Properties prop) {
		this.prop = prop;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public void setUsername(String username) {
		this.username = username;
	}
	
   /**
    *  Initialise une session d'authentification pour de connecter à la boite e-mail
	*/
	@PostConstruct
	public void init() {
	/* Session et authentification */
		
	session = Session.getInstance(prop, new javax.mail.Authenticator() {
			protected PasswordAuthentication getPasswordAuthentication() {
				return new PasswordAuthentication(username, password);
			}
		  });
	}
	
	
   /**
	* Permet d'envoyer un e-mail.
	* @param recipient adresse e-mail du destinatire.
	* @param subject sujet de l'e-mail.
	* @param content contenu de l'e-mail (Texte).
	*/
	public void sendEmail(String recipient, String subject, String content) throws MessagingException{
				
		/* Envoie du mail au destinataire */
		Message message = new MimeMessage(session);
		message.setFrom(new InternetAddress(username));
		message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(recipient));
		message.setSubject(subject);
		message.setText(content);

		Transport.send(message);	
	}


		
}