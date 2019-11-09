# Problem Statement :
“Too many mails”: Almost all our communication with the institute and also amongst the
students is based on mails. Due to this some important mails are quite often missed and students
gmail is often filled with lots of unwanted mails.

### A quick Survey:
A quick survey done on the students of our college, shows the following results:

// results


# Installation Guide :
* Install xampp/lamp on your machine
* Create login.php in directory website
* Fill the following contents inside the file :
	```
		<?php
			$hostname = 'localhost';
			$username = 'root (or any other user)';
			$password = '<insert your xamp/lamp password>';
			$database = 'mailmaintainer';
		?>
	```
* Database Creation :
	* Create database named ```mailmaintainer```
	* Create all the required tables using [this link via command line](https://stackoverflow.com/a/16486033)
	* Use ```main_table.sql``` , ```temp_table.sql```, ```mailmaintainer.sql``` for the above process.
	* This creates your basic database along with all the required tables.
	* Run the following to add default admin in mysql ``` INSERT INTO auth VALUES('manageevents123@gmail.com','<insert admin password>'); ```

