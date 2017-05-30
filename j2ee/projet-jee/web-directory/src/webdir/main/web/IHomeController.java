package webdir.main.web;

import org.springframework.web.servlet.ModelAndView;
import webdir.main.business.services.IPersonService;


public interface IHomeController {
    
    public void init();
    
    public void close();
    
    public void setPersonServ(IPersonService ps);
    
    public IPersonService getPersonServ();

    public ModelAndView printHome();
}