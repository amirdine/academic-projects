package webdir.test.business.services;

import org.junit.Test;

import static org.junit.Assert.assertFalse;
import static org.junit.Assert.assertTrue;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.TestExecutionListeners;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.support.DependencyInjectionTestExecutionListener;

import webdir.main.business.services.IUserService;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations={"TestServices-Context.xml" })
@TestExecutionListeners(DependencyInjectionTestExecutionListener.class)
public class TestUserService {

	@Autowired
	private IUserService userService;
	
	@Test
	public void testSendUserPassword() throws Exception {
		userService.sendUserPassword(1);
	}
	
	@Test
	public void testConnectTrueAuthentication() throws Exception{
		boolean result = userService.connect(1, "d8gfh");
		assertTrue("Authentification correct",result);
	}
	
	@Test
	public void testConnectFalseAuthentication() throws Exception{
		boolean result = userService.connect(2, "blabla");
		assertFalse("Mauvais authentification",result);
	}

}
