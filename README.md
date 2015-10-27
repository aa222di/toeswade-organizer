# Organizer
#### Read about use cases in PROJECT.md

## Background
This project was created in the context of the course Web development with PHP at Linnaeus University. Students were supposed to create an idea for a MVC-PHP project and develop both the criteria and structure for the project themselves.

## About the environment

**Organizer** is supposed to be customer database which lets the user create, read, update and delete customers from database. It is a part of a smaller framework which comes with a Theme module and a Navigation module. These are constructed to work with other modules which implements the two interfaces \Toeswade\IController and \Toeswade\IView. This means that the Customer module (src/Customer), is dependent on the Navigation module but not the other way around. The framework is in other word based on the files in src/Database, src/Navigation, src/Theme plus the two interfaces \Toeswade\IController and \Toeswade\IView.

### Naming standards
As a autoloader is used to load all the classes, a class a to be put in it's own file and follow the PSR-1 standard. On top of the this framework uses the letter "C" to signalise that a class is a controller and the letter "V" to signalise that the class is a view. A class without a letter before its' name is considered part of the model.

## Installation
As the project doesn't depend on other libraries, it is only necessary to clone the project from GitHub and start using it by navigating to index.php. In index.php enough code should be supplied for the user to understand how to extend the app in the future.