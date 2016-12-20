import org.junit.runner.JUnitCore;
import org.junit.runner.Result;
import org.junit.runner.notification.Failure;

public class TestRunner {
   public static void main(String[] args) {
	System.setProperty("webdriver.chrome.driver",System.getProperty("user.dir") + "/./chromedriver.exe");
      Result result = JUnitCore.runClasses(UserExportInfo.class, Slideshow.class, MenuLinks.class);
		
      for (Failure failure : result.getFailures()) {
         System.out.println(failure.toString());
      }
		
      System.out.println(result.wasSuccessful());
   }
}  	