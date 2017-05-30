package webdir.test.business.services;

import static org.junit.Assert.assertEquals;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.TestExecutionListeners;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.support.DependencyInjectionTestExecutionListener;

import webdir.main.business.services.IGroupService;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations={"TestServices-Context.xml" })
@TestExecutionListeners(DependencyInjectionTestExecutionListener.class)
public class TestGroupService{

	@Autowired
    IGroupService groupService;
	
	@Test
	public void testGetAllGroup() {
		groupService.getAllGroups();
	}
	
	@Test
	public void testGetGroup(){
		groupService.getGroup(3);
	}
	
	@Test
	public void testGroupIDExists(){
		
		boolean result = groupService.groupIDExists(2);
		assertEquals(true,result);
	}

	@Test
	public void testGroupIDNotExists(){
		
		boolean result = groupService.groupIDExists(54771);
		assertEquals(false,result);
	}
	
}