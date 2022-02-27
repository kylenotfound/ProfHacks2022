Volunteering! Fundraising! Support what you believe!
ProfsForChange is a platform for Rowan University Students, Staff and more to find different volunteering activities, fundrasing events and protests to contribute to or attend. Connect with others who and support what you believe, together!

New events are posted all the time! Register and sign up for different events or create your own! #RowanProud.

Check out the list of the most recently posted events to the right, or search for an event in the navbar.

<h2>Setup Instructions</h2>

## Prerequistes
Have the following installed:
### Windows:
* [PHP 7.4](https://windows.php.net/download#php-7.4)
* [Composer](https://getcomposer.org/)
* [Git](https://git-scm.com/downloads)
* [MySql](https://dev.mysql.com/downloads/installer/) / [MySql Workbench](https://dev.mysql.com/downloads/workbench/)
* [NodeJS](https://nodejs.org/en/)

### Mac:
>brew install php@7.4

>brew install composer

>brew install git

>brew install mysql

>brew install node

and the workbench (link above)

### Once all the above are installed, clone the repository:
>git clone (repo)

Now set up your database schema in the MySql Workbench:
Your schemea can be titled whatever you like, I named mine: "profs_for_change"

### Configure your .env
The .env file is not committed to github, but the .env.example file is
>Create a new file called .env in the root of your project directory

>Copy the boilerplate keys and values from the .env.example file into your new .env file

>Set your "DB_USERNAME", "DB_PASSWORD", "DB_DATABASE" values

Everything else should be set correctly from the .env.example file

Mine personally are 'root' and 'passoword' but these can be whatever you set up when configuring MySql workbench.
>Set "DB_DATABASE" to whatever you named your schema, eg. "profs_for_change"

### Now that your database is setup, run the following commands:
>composer install

If on windows, you may need to run 
>composer install --ignore-platform-reqs

Then run:

>npm install

>npm run dev

>php artisan migrate --seed

If you run "php artisan migrate" and it fails, or if you have just installed php for the first time, you may need to locate the source of where you installed php and edit your php.ini file and uncomment the following extensions. (remove the semicolons before each line)
* extension=php_mysql
* extension=php_mysqli
* extension=php_pdo_mysql
* extension=php_intl
* extension=php_curl
* extension=php_bz2
* extension=php_exif
* extension=php_mbstring
* extension=php_pdo_sqlite

If you had a terminal session open, be sure to restart it and then run:
>php artisan db:wipe

>php artisan migrate --seed

All the migrations should have run now succesfully.

### Next run the following to generate an app key

>php artisan key:generate

## To launch the devlopment server:

>php artisan serve

In your web browser of choice, go to: http://localhost:8000 and you should see the main landing page.