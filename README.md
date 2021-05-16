# Otrium challange

This is the project challange for the Otrium company .

# Requirements

Here are the basic dependency requirements.
- php 7.2 or later
- mySQL 8.0 or later
- Apache or nginx to serve
- Composer


# How to setup

- Run following command after clone the repository to web directory. This will create a "vendor" folder inside the project.
```
composer install 
```

- import the database into mysql
- Then update the database information in "config.php" file.
- Make sure you give propper permission to "csv" and "logs" directory.

# How to run 

You can open the index.php file from the browser you preferred using relative path to your web server.

# Unit test

I have included basic unit tests inside "tests" folder. you can run the test by running following command.
```
./vendor/bin/phpunit tests
```