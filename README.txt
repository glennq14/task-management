The application require php-slite3 for database connection:

To verify if the SQLite3 is available and enabled.
> php --ri sqlite3
 
Install PHP-FPM
> sudo apt install php-fpm -y

Install PHP SQLite3.
> sudo apt install php-sqlite3

The application was developed on the PHP version 8+ version

I used apache2 as web server.

See conf files on apache-conf directory and you can use them for virtual hosting setup.

To setup new database: Please see the schema file on api/database/schema.sql

API usage:
Get all task records
GET /api/task           //dev.rest.task-management.com/api/task

Single record
GET /api/task/{id}      //dev.rest.task-management.com/api/task/1

Adding task
POST /api/task          //dev.rest.task-management.com/api/task

Update task
PUT /api/task/{id}      //dev.rest.task-management.com/api/task/1

DELETE task
DELETE /api/task/{id}   //dev.rest.task-management.com/api/task/1

Front end images are found in _ARTIFACTS directory. //dev.task-management.com

Thank you!
