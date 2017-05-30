package webdir.main.web.imp.validator;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.springframework.stereotype.Service;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;
import org.springframework.validation.Validator;

import webdir.main.model.User;



@Service
public class UserValidator implements Validator {

    public boolean supports(Class<?> clazz) {
        return User.class.isAssignableFrom(clazz);
    }

   
    public void validate(Object target, Errors errors) {
      
    	User user = (User) target;
    	
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "id", "user.id", "Veuillez entrer votre login.");
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "password", "user.password", "Veuillez entrer votre mot de passe");
        
        if (user.getId() != null){
        	
           if(user.getId().toString().length() > 10) {  
              errors.rejectValue("id", "user.id", "Identifiant incorrect");  
            }
           
           String ID_PATTERN = "[0-9]+";
           Pattern pattern = Pattern.compile(ID_PATTERN);
           Matcher matcher = pattern.matcher(user.getId().toString());  
           
           if (!matcher.matches()) {  
        	    errors.rejectValue("id", "user.id", "Identifiant incorrct");  
           } 
        }
    }
    
    
    public void validateAuthentification(boolean authentification, Errors errors){
    	
    	if (authentification == false) {  
            errors.rejectValue("password", "user.password", "Authentification incorrect");  
        } 
    }
    
 
}