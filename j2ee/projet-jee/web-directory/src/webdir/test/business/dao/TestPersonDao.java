package webdir.test.business.dao;

import static org.junit.Assert.assertEquals;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Collection;
import java.util.Date;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.TestExecutionListeners;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.support.DependencyInjectionTestExecutionListener;

import webdir.main.business.dao.IPersonDao;
import webdir.main.model.Group;
import webdir.main.model.Person;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations={"TestDao-Context.xml" })
@TestExecutionListeners(DependencyInjectionTestExecutionListener.class)
public class TestPersonDao {

	@Autowired
	private IPersonDao personDao;


	//@Test
	public void testAddPersn() throws ParseException {

		Person person = new Person();

		person.setFirstname("Saïkou");
		person.setLastname("Bah");

		String date_s = " 1992-07-14";
		SimpleDateFormat dt = new SimpleDateFormat("yyyy-mm-dd");
		Date birthDay = dt.parse(date_s);
		person.setBirthdate(birthDay);
		person.setPassword("aaaa");
		person.setEmail("saïkou.bah@hotmail.fr");
		person.setWebsite("saikou.bah.perso.fr");
		//person.setGroup(group);

		personDao.addPerson(person);
	}

	@Test
	public void testFindAll() {

		Collection<Person> persons = personDao.getAllPersons();
        
		
		for (Person person : persons) {
			System.out.println(person);
		}
	}

	@Test
	public void testGetPerson() throws Exception{
		Person person = personDao.getPerson(1);
		
		Person exceptedPerson = new Person();
		
		exceptedPerson.setId(1);
		exceptedPerson.setFirstname("Amirdine");
		exceptedPerson.setLastname("MDJASSIRI");
		exceptedPerson.setEmail("mdjassiri.amirdine@gmail.com");
		exceptedPerson.setWebsite("http://amirdine.mdjassiri.etu.perso.luminy.univ-amu.fr/");
		exceptedPerson.setPassword("d8gfh");
		
		String date_s = "25/08/1990";
		SimpleDateFormat dt = new SimpleDateFormat("dd/MM/yyyy");
		Date birthdate = dt.parse(date_s);
		exceptedPerson.setBirthdate(birthdate);
		
		Group groupA = new Group();
		groupA.setGroupID(1);
		groupA.setName("Groupe A");
		
		exceptedPerson.setGroup(groupA);
		
		boolean result= person.toString().contentEquals(exceptedPerson.toString());
	
		assertEquals(true,result);
	}
	
	
	
	@Test 
	public void testPersonIdExits(){
		
		boolean result = personDao.personIDExists(1);
		assertEquals(true,result);
	}
	
	@Test 
	public void testPersonIdNotExits(){
		
		boolean result = personDao.personIDExists(457448741);
		assertEquals(false,result);
	}
	
	//@Test
	public void testUpdatePerson() throws ParseException{
		
		Person person = new Person();
		
		person.setId(1);
		person.setFirstname("Amirdine");
		person.setLastname("toto");
		person.setWebsite("amirdine.perso.fr");
		String date_s = " 1994-07-14";
		SimpleDateFormat dt = new SimpleDateFormat("yyyy-mm-dd");
		Date birthdate = dt.parse(date_s);
		person.setBirthdate(birthdate);
		
		personDao.updatePerson(person);
	}
	

}