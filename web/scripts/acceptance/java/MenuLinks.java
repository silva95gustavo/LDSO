import java.util.regex.Pattern;
import java.util.concurrent.TimeUnit;
import org.junit.*;
import static org.junit.Assert.*;
import static org.hamcrest.CoreMatchers.*;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.Select;

public class MenuLinks {
  private WebDriver driver;
  private String baseUrl;
  private boolean acceptNextAlert = true;
  private StringBuffer verificationErrors = new StringBuffer();

  @Before
  public void setUp() throws Exception {
    driver = new ChromeDriver();
    baseUrl = "http://staging.cuidadores.tk/";
    driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
  }

  @Test
  public void testMenuLinks() throws Exception {
    driver.get(baseUrl + "/pt-pt/node/35");
    driver.findElement(By.linkText("Sou um cuidador?")).click();
    driver.findElement(By.linkText("Serviços")).click();
    assertEquals("Serviços | Associação Cuidadores", driver.getTitle());
    driver.findElement(By.linkText("Notícias e Eventos")).click();
    assertEquals("Notícias e Eventos | Associação Cuidadores", driver.getTitle());
    driver.findElement(By.linkText("Fórum")).click();
    assertTrue(isElementPresent(By.linkText("Website")));
    driver.findElement(By.linkText("Website")).click();
    driver.findElement(By.linkText("Sobre nós")).click();
    assertEquals("Sobre nós | Associação Cuidadores", driver.getTitle());
    driver.findElement(By.linkText("Contacte-nos")).click();
    assertEquals("Contacte-nos | Associação Cuidadores", driver.getTitle());
    driver.findElement(By.linkText("Donativos")).click();
    assertEquals("Donativos | Associação Cuidadores", driver.getTitle());
  }

  @After
  public void tearDown() throws Exception {
    driver.quit();
    String verificationErrorString = verificationErrors.toString();
    if (!"".equals(verificationErrorString)) {
      fail(verificationErrorString);
    }
  }

  private boolean isElementPresent(By by) {
    try {
      driver.findElement(by);
      return true;
    } catch (NoSuchElementException e) {
      return false;
    }
  }

  private boolean isAlertPresent() {
    try {
      driver.switchTo().alert();
      return true;
    } catch (NoAlertPresentException e) {
      return false;
    }
  }

  private String closeAlertAndGetItsText() {
    try {
      Alert alert = driver.switchTo().alert();
      String alertText = alert.getText();
      if (acceptNextAlert) {
        alert.accept();
      } else {
        alert.dismiss();
      }
      return alertText;
    } finally {
      acceptNextAlert = true;
    }
  }
}
