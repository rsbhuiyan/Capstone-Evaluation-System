# <img src = "app/images/wsulogo.svg.png" width="50" height="50"> Capstone-Course-Evaluation-System

<img src="app/images/cces.png" height="240" align ="center">

[Introduction](#introduction) | [About the Project](#about) | [Using the Application](#using) | [Contributing](#contributing)

<a name="introduction"/>

## Introduction

This README file provides an overview of the Capstone Course Evaluation project, including instructions on how to use the application and details about the project.

<a name="about"/>

## About the Project

The Capstone Course Evaluation System is a web application designed to allow the admin, professors, and graduate technical assistants (GTAs) of Wayne State University to evaluate the capstone course they have taken. The purpose of the application is to create a centralized location for the professors and GTA to manage capstone grades and evaluations throughout a given semester.

<a name="using"/>

## Using the Application
`Pre-Req`
- The following must be installed on your device in order to run the application. One can download all of these separately or together using XXAMP. A great installation tutorial can be found <a href = "https://www.sitepoint.com/how-to-install-php-on-windows/"> here </a>! <br>
  - Apache 2.4 installed recommended in C:\Apache24 folder<br>
  - MySql    8 installed<br>
  - PHP      8 installed<br>

- Once PHP is installed open the php.ini file in and uncomment the following extensions: 
  - extension=openssl
  - extension=pdo_mysql
  - extension=zip
- and the following extension
    - error_reporting = E_ALL & ~E_NOTICE & ~E_DEPRECATED
-  Uncomment and edit STMP setting <br>
          example: <br>
          [mail function] <br>
          ; For Win32 only. <br>
          ; https://php.net/smtp <br>
          SMTP = smtp.gmail.com <br>
          ; https://php.net/smtp-port <br> 
          smtp_port = 587 <br>
    
`To use the Capstone Course Evaluation application, follow these steps:`

1. Download zip
2. Unzip to temp location
3. Update base location so that the folder name is 'CapstoneProject' so that it is CapstoneProject/app
3. Move the 'CapstoneProject' folder from temp location to htdocs folder under Apache24 install location (or if downloaded with XXAMP in the xxamp/htdocs folder)
4. Create/select database in mysql: "dbname"
5. Update the database configuration file (htdocs/app/classes/Dbh.class.php) with your database credentials.
    - Example
      - private $server = '127.0.0.1';
      - private $database = 'ccesdb';
      - private $username = 'john';
      - private $password = 'pass1234'; 
   - note in this example "dbname" = ccesdb	
6. Using MySQL workbench, sign into the user you have connected with the account and run DBS-00.sql found in the 'database' folder. DBS-00.sql has data inserted into it to create a real working simulation. If you would like to just create the tables with three users (admin, professor, GTA) you can choose to run DBS-01.sql.
7. Run the application.
    
<a name="contributing"/>    
    
## Contributing 

This project was made over the course of 12 weeks in the Senior Capstone class as their senior project. Lead by Cristina Powers, the team consisted of Abigail Noyes, Raad Bhuiyan, and Bharath Palanisamy. This project is now of ownership with the department of computer science at Wayne State University. If the university would like to change, contribute, or add to the project they can do so by simply doing:

1. Fork the project repository.
2. Make your changes to the code.
3. Submit a pull request with a description of your changes.
    
## Contact

If you have any questions or comments about the Capstone Course Evaluation project, please contact the project maintainer.
