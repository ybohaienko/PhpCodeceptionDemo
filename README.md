# PhpCodeceptionDemo
DEMO project to demonstrate capabilities of testing framework Codeception on Google.com website

### Prerequisites
* **git**
* **JDK >= 1.8.0_131**
* **PHP >= 7.1.32**
* **PHP modules/extensions (cURL, DOM, mbstring, etc.)**
* **Chrome browser >= 79**

### Used tech:
* PHP
* Codeception
* Selenium
* Chromedriver 

### Scenario
1. Go to Google.com
2. Search for “insly.com”
3. Verify that “https://insly.com/en/” link is present in search results
4. Click on link
5. Verify that title equals “Insly - Simple Insurance Software for Brokers and MGAs.”

### Run 
#### Clone the project locally
```
git clone -b develop https://github.com/ybohaienko/PhpCodeceptionDemo.git
```
#### To conveniently run the tests, execute from the root directory (only for Linux and MacOS):
```
sh run.sh -h
```