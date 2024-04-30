![Alt text](public/assets/img/logo.jpg)

## About My Project

Codischool, Still to be finished.



Created by Pavel Filingeri.


## Why i have choosed Laravel?

<strong> Clean Syntax: </strong>Laravel's syntax is elegant and easy to understand, enhancing developer productivity and code readability.

<strong> Modular System: </strong> Its modular packaging system and Composer dependency manager allow for easy integration of functionalities via pre-built packages or custom modules.

<strong> Built-in Features: </strong> Laravel offers built-in features like authentication, caching, and sessions, reducing development time and ensuring robust security.

<strong> Eloquent ORM: </strong> Laravel's Eloquent ORM simplifies database operations by using PHP syntax, eliminating the need for complex SQL queries and improving code organization.

<strong> Active Community: </strong> With a large and active community, Laravel provides extensive support, resources, and third-party integrations, ensuring developers can find solutions and stay updated with the latest trends.

## Run Laravel for the first time


* Install Composer

Windows/Linux
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
```

Mac Os (with Brew)

```zsh
brew install composer
```

* Env Variables ( If any)

```zsh
cp .env.example .env
```

* Install package ( If any)

```zsh
composer install
```

* Import db locally 

⚠️IMPORTANT⚠️: The db is inside the github repository, the name of it is: <strong> CODISCHOOL.sql </strong>
⚠️IMPORTANT⚠️: Check DB Name, Username and password for the auth of the users 

* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=CODISCHOOL
* DB_USERNAME=root


```zsh
NAME: CODISCHOOL
utf8_general_ci
```

* Migrate and start ( If any)

```zsh
php artisan migrate
php artisan db:seed
php artisan serve
```

◉‿◉ You can now access your project at localhost:8000 :)

## If for some reason your project stop working do these:
- `composer install`
- `php artisan migrate`








