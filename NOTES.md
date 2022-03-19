# Notes

*Database setup, structure change, tests setup, etc.*

#Environment
* PHP 7.4.3
* OS: Ubuntu 20.04.3
* mysql Ver 8.0.28
* server Apache/2.4.41 (Ubuntu)

#Changes
* **Structure**
  * Separate the application folder to 3:
  
    * Application which contains our handler with use cases.
    * Domain for our business logic without pure php
    * Infrastructure for external libraries: doctrine entities, repositories, controller, and any other links to framework component.
    
* **some changes**
  * Adding a DTO in order to convert request body into an object using paramConverter with FosRestBundle.
  * Adding a DataMapper to map between dto, view models, domain entity and doctrine entity to decouple our domain from database and other external libraries.
  * Updated **testFight** on **ArenaTest** to make it passed because as the example tested, the fighter 2 should win.
  * Adding Validator component to validate api input
  * Adding **FosRestBundle** to help on managing api and converting request body to object
  * Change endpoint from knight to knights as it is recommended on building restfull api.
  * Adding **dama/doctrine-test-bundle** for not changing test database state after running tests
  * Adding the Uuid symfony component for storing uuids identifier for entities which generate unique values and secure the ids.

#Database Setup
run the following command
* make database

for the test database run the following
* make database-test

#Run the project

* composer install
* make database
* symfony serve
* http://localhost:8000/knights
