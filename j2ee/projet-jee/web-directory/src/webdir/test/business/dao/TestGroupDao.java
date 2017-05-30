package webdir.test.business.dao;

import static org.junit.Assert.assertEquals;

import java.util.Collection;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.TestExecutionListeners;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.support.DependencyInjectionTestExecutionListener;

import webdir.main.business.dao.IGroupDao;
import webdir.main.model.Group;
import webdir.main.model.Person;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations={"TestDao-Context.xml" })
@TestExecutionListeners(DependencyInjectionTestExecutionListener.class)
public class TestGroupDao {

	@Autowired
	private IGroupDao groupDao;

	//@Test 
	public void testAddGroup(){
		
		Group group = new Group();
		group.setName("Groupe E");
		
		//groupDao.addGroup(group);
	}
	
	@Test
	public void testGetAllGroups() {

		Collection<Group> groups = groupDao.getAllGroups();
		
		for (Group group : groups) {
			System.out.println(group);
		}
	}

	@Test
	public void testGetGroup() throws InterruptedException{

		Group group = groupDao.getGroup(1);
		
		Group exceptedGroup = new Group();
		
		exceptedGroup.setGroupID(1);
		exceptedGroup.setName("Groupe A");
		
		boolean result = exceptedGroup.toString().contentEquals(group.toString());
		assertEquals(true,result);
	}
	
	@Test
	public void testGroupContent() {
		
		int groupID = 1;
		Collection<Person> persons = groupDao.getContentGroup(groupID);
		
		System.out.println("Contenu du Groupe " + groupDao.getGroup(groupID).getName());
		for (Person person : persons) {
			System.out.println(person);
		}
	}
	
	@Test 
	public void testGroupIDExits(){
		
		boolean result = groupDao.groupIdExists(1);
		assertEquals(true,result);
	}
	
	@Test 
	public void testGroupIdNotExits(){
		
		boolean result = groupDao.groupIdExists(555454577);
		assertEquals(false,result);
	}
	
}