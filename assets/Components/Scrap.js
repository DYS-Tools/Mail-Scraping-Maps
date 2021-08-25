import React from 'react';

webdriver = require('selenium-webdriver'),
By = webdriver.By,
until = webdriver.until,
Builder = webdriver.Builder,
chrome = require('selenium-webdriver/chrome'),
firefox = require('selenium-webdriver/firefox');

var path = require('chromedriver').path;

class Scrap extends React.Component {

  // Selenium test TODO: change with good request
  scrapMaps = async (url) =>{

		// set driver   TODO: --disable-web-security
		console.log('scrapMaps function');
		let driver = chrome.Driver.createSession(new chrome.Options().addArguments(['--no-sandbox', '--headless', '--disable-dev-shm-usage', '--disable-gpu', '--disable-extensions',
		'excludeSwitches', 'enable-logging', '--ignore-ssl-errors', '--ignore-certificate-error', '--start-maximized', '--enable-automation',
		'--disable-blink-features=AutomationControlled', '--useAutomationExtension=False' ]), new 
		chrome.ServiceBuilder(path).build());
		driver.manage().timeouts().implicitlyWait(2000);
		driver.manage().window().setSize(993, 745); // it's a size of the browser window with full screen and open developper tools in chrome

		await driver.get(url);

		// find position
		const name = await driver.findElement(By.xpath("/html/body/jsl/div[3]/div[10]/div[8]/div/div[1]/div/div/div[4]/div[1]/div[1]/div/a")).getText();
		driver.quit();
		return name;

  }

  render() {

    let variable = this.scrapMaps('https://www.google.fr/maps/search/bijoutiers/@49.7820353,0.4600253,12z/');
    //let text = "hello";

    return (
        <div>
          <br/><br/><br/><br/><br/><br/>
            <p>Scrap API page with js (Pas toucher)</p>
        </div>
    );
  }
}

export default Scrap;

