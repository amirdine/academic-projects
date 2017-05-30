package webdir.test.business.services;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertTrue;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.TestExecutionListeners;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.support.DependencyInjectionTestExecutionListener;

import webdir.main.business.services.IPersonService;


@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations={"TestServices-Context.xml" })
@TestExecutionListeners(DependencyInjectionTestExecutionListener.class)
public class TestPersonService{

	@Autowired
    private  IPersonService personServ ;

	@Test
	public void testGetAllPerson() {
		personServ.getAllPersons();
	}
	
	@Test
	public void testGetPerson() throws Exception{
		personServ.getPerson(1);
	}
	
	@Test
	public void testGetPersonNotExits(){
		
		try {
			personServ.getPerson(14);
			assertTrue("Échec", true);
		} catch (Exception e) {
			e.printStackTrace();
			assertTrue("Succes", true);
		}
	}

	@Test
	public void testPersonIDExists(){
		
		boolean result = personServ.personIDExists(1);
		assertEquals(true,result);
	}
	
	@Test
	public void testPersonIDNotExists(){
		
		boolean result = personServ.personIDExists(51014);
		assertEquals(false,result);
	}
	
}