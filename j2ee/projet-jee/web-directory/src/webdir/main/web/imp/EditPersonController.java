package webdir.main.web.imp;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.LinkedHashMap;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.ModelAndView;

import webdir.main.business.services.IGroupService;
import webdir.main.business.services.IPersonService;
import webdir.main.model.Group;
import webdir.main.model.Person;
import webdir.main.model.User;
import webdir.main.web.imp.validator.PersonValidator;


@RequestMapping("*")
@Controller()
public class EditPersonController {
	
	
	@Autowired()
    User user;

    @ModelAttribute("user")
    public User newUser() {
        return user;
    }
    
    protected final Log logger = LogFactory.getLog(getClass());
 
    
    /********************************************************
     *   				EDITION                             *
     *                                                      *
     ********************************************************/

    	@Autowired
    	IPersonService personService;
       
    	@Autowired
     	IGroupService groupService;
       
    	@Autowired
        PersonValidator personValidator;
    	
    	
    	 /***   Liste des groupes ***/	
    	 @ModelAttribute("groups")
    	    public Map<Integer, String> productTypes() {
    	        
    	    	Map<Integer, String> groups = new LinkedHashMap<>();
    	    	
    	        for(Group group: groupService.getAllGroups()){
    	        	 groups.put((int) group.getGroupID(), group.getName()); 	
    	        }
    	        return groups;
    	 }
    	
    	  /***   GET  ***/	
    	 @RequestMapping(value = "/edit", method = RequestMethod.GET)
    	    public ModelAndView editGet(@ModelAttribute Person p) throws NumberFormatException, Exception {
    	        logger.info("Running " + this);
    	        

    			if(user.getId()== null || user.getId().isEmpty()){
    				return new ModelAndView("home");
    			}
    			
    	        Person userProfil = personService.getPerson(new Integer(user.getId()));
    			ModelAndView modelAndView = new ModelAndView("edit");
    			
    			modelAndView.addObject("firstname", userProfil.getFirstname());
    			modelAndView.addObject("lastname", userProfil.getLastname());
    			modelAndView.addObject("email", userProfil.getEmail());
    			
    			String date = new SimpleDateFormat("yyyy-MM-dd").format(userProfil.getBirthdate());
    			
    			modelAndView.addObject("birthdate", date);
    			
    			
    	        return modelAndView;
    	    } 
    
    	 
    	   /***   Post  ***/
    	 
    	 @RequestMapping(value = "/edit", method = RequestMethod.POST)
    	    public ModelAndView editPost(@ModelAttribute Person person,  BindingResult result, HttpServletRequest request) 
    	    		throws NumberFormatException, Exception {
    	    	
    	    	personValidator.validate(person, result, request);
    	    	
    	    	if (result.hasErrors()) {
    	    		
    	    		Person userProfil = personService.getPerson(new Integer(user.getId()));
    	    		ModelAndView modelAndView = new ModelAndView("edit");
    	    		
    	    		modelAndView.addObject("firsname", userProfil.getFirstname());
    	    		modelAndView.addObject("lastname", userProfil.getLastname());
    	    		modelAndView.addObject("email", userProfil.getEmail());
    	    		String date = new SimpleDateFormat("yyyy-MM-dd").format(userProfil.getBirthdate());
    	    		modelAndView.addObject("birthdate", date);
    	               
    	    		return modelAndView;
    	        }
    	    	
    	    	
    	    	
    	    	person.setId(new Integer(user.getId()));
    	    	
    	    	if(!request.getParameter("group_").isEmpty()){
    	    	    Group group =  groupService.getGroup(new Integer(request.getParameter("group_")));
    	    	    person.setGroup(group);
    	    	}
    	    	
    	    	String date_s = request.getParameter("date");
    			SimpleDateFormat dt = new SimpleDateFormat("yyyy-MM-dd");
    			Date birthdate = dt.parse(date_s);
    			
    	    	person.setBirthdate(birthdate);
    	    
    	    	personService.updatePerson(user, person);
    	        return  new ModelAndView("success/edit");
    	    }
    	 
    	 
 	 
}