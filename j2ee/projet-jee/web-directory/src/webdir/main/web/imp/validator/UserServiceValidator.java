package webdir.main.web.imp.validator;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;

import webdir.main.business.services.IGroupService;
import webdir.main.business.services.imp.UserService;

@Service
public class UserServiceValidator {
	
	@Autowired
 	IGroupService groupService;
	
	public void validate(Object target, Errors errors, HttpServletRequest request) {
	      
		UserService userService = (UserService) target;
    	
    	ValidationUtils.rejectIfEmptyOrWhitespace(errors, "id", "userService.id", "Veuillez entrer un identifiant");
    
        String NUMBER_PATTERN =  "[0-9]+";
        
        if(!matches( NUMBER_PATTERN, request.getParameter("id"))){
          errors.reject("id", "L'identifiant doit être un nombre.");  
        }
        
      
	}
	
	
	private boolean matches(String stringPattern, String input){
		
		 Pattern pattern = Pattern.compile(stringPattern);  
		 Matcher matcher = pattern.matcher(input); 
		 
		 if (!matcher.matches()) {  
			return false;   
	     } 
		 
		 return true;
	}
	
}