#![alt text][logo] Bank of Rory Database Assignment
 [logo]: https://raw.github.com/rorynee/bankOfRoryDatabaseAssignment/master/website/bankofrory/images/borlogo.png  "Bank Of Rory Logo"

[Click here to view demo video]( https://www.youtube.com/watch?v=lB45oAA2Gcw "AIT - Databases 4 Second Assignment")

## Assignment Outline

**Task:** You will develop an online system of your choice that uses PHP and a MySQL database. You may also incorporate a NoSQL database but this is not a mandatory requirement of the project.

**Requirements Includes:**

New Users can either self-registration or be done by another User.

Also carry our simple crud operation.

There should be 2 or more types of users with different privileges.

The MySQL database must be Normalised to 3NF.

The database will use Stored Procedures to execute queries.

Please view ‘Database Assignment Tasks.pdf’ for the full details of the assignment.

##Outline of the system

The system that I have made is a banking system called “Bank of Rory”. This system could be used in a bank together with some kind of cash dispensing facility attached to it.
This system was built in PHP using the Slim Framework. The Slim Framework is a restful API. You will notice that throughout this system the URL are always restful. The main index.php file serves as a routing file for Slim and this file connects the URL’s with the function need to load them. These function are in the function.php, access.php and static_fn.php files.  

There are two database PHP file include in the top section of the index file. These both show the database connection in a class using a singleton pattern. I have used this to stop multiple connection object being generated.  

This system also used a MySQL database and a NoSQL (Mongodb) database. For information on how to start the project please view the “Running Bank of Rory” section.

There are three different types of user roles incorporated into the system.

**Role 1:** A Normal user role has access to creating an account, doing various updates including making a withdrawal, depositing money and updating their own account information. The user will also be able view recent transaction on the “Show history” page and the user can delete their account. By doing a delete they will fully delete any record of their account. A user can also view tickets (customer support enquire) and open tickets. The ticket system data is stored in the NoSQL database. 

**Role 2:** The Support Staff role has access to the ticketing system mentioned above. They can answer tickets and change the status of the tickets. They are also able to delete tickets once they are “closed”. They have limited access to the accounts but will need it to be able to investigate any problems in the accounts. Support staff will be able to update personal information but will not be able to change the status of an account or update the balance of an account.

**Role 3:** The Admin role will have complete access to all accounts and ticket system. The Admin role can update their own account and also add new accounts. The Admin role can also See the History, update account types and update the balance of an account but a record of the change to a balance will be kept in the “history” for that user.  
The administrator will have the only access to the report feature on the website. There will be five reports available that access information for all the tables in the database. The fifth report includes data from both databases in the report showing how many tickets each customer has sent in to the support staff. 

***

## Installation and Usage

As per the assignment outline please download a Uniform XAMPP server and install Mongodb on it in a folder called ‘mongodb’. Please use the 64bit version. This should be installed on a USB stick as per the assignment outline. 

Start XAMP server as usual. The NoSQL/Mongodb demon starts by running a bat file called “mongostartdemon.bat”. To close the Mongodb Demon press ctrl c and y for yes. I have created this for ease of use and it should be put in the main xamp folder. 
The bankofrory folder should be put in the following location “xampp\htdocs\bankofrory”. The following URL will load the home page “http://localhost/bankofrory/”. 

The NoSQL/Mongodb database can be accessed on command line using the “mongostart.bat” file when it is placed in the ‘mongodb’ folder. Mongodb config file is also supplied and can replace the file already in the ‘mongodb’ folder 

***

##System Login’s

The following are the Login details that you will need to access the system.

Username: admin@bankofrory.com - Password: admin1234

Username: support@bankofrory.com - Password: support1234

Username: liam@example.com - Password: 1234567

Username: will@yourbank.com - Password: 1234567

Username: billy@ait.ie - Password: 1234567


***

##Additional Information
Please view the ‘Assignment_two_writeup.pdf’ for further information about this assignment. 


