package webdir.main.web.imp;

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

import webdir.main.business.services.IPersonService;
import webdir.main.business.services.IUserService;
import webdir.main.business.services.imp.UserService;
import webdir.main.model.Person;
import webdir.main.model.User;
import webdir.main.web.imp.validator.UserServiceValidator;
import webdir.main.web.imp.validator.UserValidator;

@RequestMapping("*")
@Controller()
public class UserServiceController {

	@Autowired()
	User user;

	@ModelAttribute("user")
	public User newUser() {
		return user;
	}

	@Autowired
	UserValidator userValidator;
	
	@Autowired
	UserServiceValidator userServiceValidator;
	

	@Autowired
	IUserService userService;

	@Autowired
	IPersonService personService;

	/********************************************************
	 * AUTHENTIFICATION * *
	 ********************************************************/

	/*** GET ***/

	protected final Log logger = LogFactory.getLog(getClass());

	@RequestMapping(value = "/login", method = RequestMethod.GET)
	public ModelAndView login(@ModelAttribute User user) {
		logger.info("Running " + this);
		return new ModelAndView("login");
	}
	
	/*** GET ***/


	@RequestMapping(value = "/logout", method = RequestMethod.GET)
	public ModelAndView logout() {
		this.user.setId("");
		this.user.setPassword("");
		logger.info("Running " + this);
		return new ModelAndView("logout");
	}

	/*** POST ***/
	@RequestMapping(value = "/login", method = RequestMethod.POST)
	public ModelAndView connect(@ModelAttribute User user, BindingResult result) throws Exception {

		userValidator.validate(user, result);

		if (result.hasErrors()) {
			return new ModelAndView("login");
		}

		if (userService.connect(new Integer(user.getId()), user.getPassword())) {
			this.user.setId(user.getId());
			this.user.setPassword(user.getPassword());

			ModelAndView modelAndView = new ModelAndView("success/authentication");

			long id = new Integer(this.user.getId());

			Person person = personService.getPerson(id);
			String name = person.getFirstname();

			modelAndView.addObject("name", name);
			return modelAndView;
		}

		userValidator.validateAuthentification(false, result);
		return new ModelAndView("login");
	}

	/********************************************************
	 * User Service * (Mail) *
	 ********************************************************/

	/*** GET ***/
	@RequestMapping(value = "/password/recovery", method = RequestMethod.GET)
	public ModelAndView passwordGet(@ModelAttribute UserService userService) 
			throws NumberFormatException, Exception {
		
		
		logger.info("Running " + this);
		ModelAndView modelAndView = new ModelAndView("recovery");

		return modelAndView;
	}

	/*** POST ***/
	@RequestMapping(value = "/password/recovery", method = RequestMethod.POST)
	public ModelAndView passwordPost(@ModelAttribute UserService userService,  BindingResult result,  HttpServletRequest request) throws NumberFormatException, Exception {
		logger.info("Running " + this);

		userServiceValidator.validate(userService, result, request);
		
		if (result.hasErrors()) {
			return new ModelAndView("recovery");
		}
		
		ModelAndView modelAndView = new ModelAndView("success/recovery");

		this.userService.sendUserPassword(new Integer(userService.getId()));
		return modelAndView;
	}
}