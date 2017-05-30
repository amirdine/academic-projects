package webdir.test.business.services;

import javax.mail.MessagingException;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.TestExecutionListeners;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.support.DependencyInjectionTestExecutionListener;

import webdir.main.business.services.IEmailService;


@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations={"TestServices-Context.xml" })
@TestExecutionListeners(DependencyInjectionTestExecutionListener.class)
public class TestEmailService {
	
	@Autowired
	IEmailService emailService;

	@Test
	public void testSendEmail() throws MessagingException {
		
		String recipient = "mdjassiri.amirdine@yahoo.fr";
		String subject   = "Récupération de mot de passe";
		String content   = "Bonjour, \n Votre mot de passe est ******* . \n\n "
				         + "L'Équipe Secu Webdirectory. \n";
		
		emailService.sendEmail(recipient, subject, content);	
	}

}
