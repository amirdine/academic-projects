package webdir.main.web.imp.validator;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;

import webdir.main.business.services.IGroupService;
import webdir.main.model.Person;

@Service
public class PersonValidator {
	
	@Autowired
 	IGroupService groupService;
	
	public void validate(Object target, Errors errors, HttpServletRequest request) {
	      
    	Person person = (Person) target;
    	
    	ValidationUtils.rejectIfEmptyOrWhitespace(errors, "firstname", "pers.firstname", "Veuillez entrer votre prénom");
    	ValidationUtils.rejectIfEmptyOrWhitespace(errors, "lastname",  "pers.lastname", "Veuillez entrer votre nom de famille");
    	//ValidationUtils.rejectIfEmptyOrWhitespace(errors, "birthdate", "pers.birthdate", "Veuillez entrer votre date de naissance");
    	ValidationUtils.rejectIfEmptyOrWhitespace(errors, "email", "pers.email", "Veuillez entrer votre adresse e-mail");
       
        String NAME_PATTERN = "[a-zA-Z]+";
        String EMAIL_PATTERN = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@"+ "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";  
        String NUMBER_PATTERN =  "[0-9]+";
        
        if( !person.getFirstname().isEmpty() && !matches(NAME_PATTERN, person.getFirstname())){
          errors.rejectValue("firstname", "person.firstname", "Format du prénom incorrect");  
        }
        
        if( !person.getLastname().isEmpty() && !matches(NAME_PATTERN, person.getLastname())){
            errors.rejectValue("lastname", "person.lastname", "Format du nom de famille incorrect");  
        }
        
        if(!person.getEmail().isEmpty() && !matches(EMAIL_PATTERN, person.getEmail())){
            errors.rejectValue("email", "person.email", "Format e-mail incorrect");  
        }  
        
        System.out.println("---> " + (request.getParameter("date")));
         if(!isValideDate(request.getParameter("date"))){
        	 errors.reject("date", "Date incorrecte");  
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
	
	
	private boolean isValideDate(String dateToValidate){
	
		
			if(dateToValidate == null){
				return false;
			}
			
			SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
			sdf.setLenient(false);
			
			try {
				
				Date date = sdf.parse(dateToValidate);
				System.out.println(date);
			
			} catch (ParseException e) {
				e.printStackTrace();
				return false;
			}
			
			return true;
	}
	

}