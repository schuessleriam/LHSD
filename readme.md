
This web app was created using a Linux - Apache - MySQL - PHP stack, with the help of JavaScript, including jQuery (Ajax). The application was built for the office of church relations to better handle their high school directory, at all levels, by creating a single source of truth for all forms and publications of the directory. 

The publicly viewable portion of this application can be found at: https://www.valpo.edu/church-relations/lhs-directory/

Project Symposium link: https://scholar.valpo.edu/cus/688/



**Some files have been omitted on the public github repository for security purposes**

----------------------------------------------------------------------------------
 
This system should be entirely ready for implementation given the following:

1. Import the SQL dump onto server. The database is mysql.

2. Change the credentials within the config.php file (resources/config/config.php)
to the database containing this dump. There is currently only one database account
assumed within the config file. We suggest creating another database account with
limited permissions for use in files located in the outside_form directory to
better protect from SQL injection.

3. Obtain a google maps api key (https://developers.google.com/maps/documentation/javascript/)
Place this key in the script include tag in map.php, replace "YOUR_KEY_HERE"

Notes:

		-This app uses relative file paths, if placing the outside_form and public_info
		directories to other part of server, be sure to update file paths to the maps.php
		file and linked files

		-Security is done through php sessions. 

Credits: Alex Schuessler, David Schmeling, Franklin Kirui, Tyler Ammons 2018
