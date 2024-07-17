# Contact Form Web-based application

This is PHP application that uses Docker for containerization and PDO for secure database interactions. The application includes a form to capture user input, validate it, save it to a SQL database, and display the saved entries. The application uses Bootstrap for styling and includes a top navigation bar with active links for the form and the list of contacts.

## Prerequisites or tested on
-   PHP 7.4
- Make sure you have a working LAMP/WAMP/MAMP stack. You can use Homestead, Valet, or  Docker to run it
- Visit https://laravel.com/docs/10.x for references 

## Installation

Clone the repository locally 
``` git clone git@github.com:ymakanda/contact-form.git ```

- cd to your working directory ``` cd contact-form ```

- update contact-form/src/config/database.php for db details

- Database Setup
    - copy SQL data from contact-form/db [text](db/contacts.sql)
Create a database and a table to store the form data. Here’s a sample SQL script to create the necessary table:

## To run it if you have docker

```bash
docker-compose up --build

```

This command will build the Docker images and start the containers. You can access the form at http://localhost:8080/index.php and the list of contacts with pagination at http://localhost:8080/list_contacts.php.

