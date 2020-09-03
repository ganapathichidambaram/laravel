## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation of laravel

* Download Composer with curl:

```
curl -sS https://getcomposer.org/installer |php
```

* Move the Composer file to /usr/local/bin directory:

```
sudo mv composer.phar /usr/bin/composer
```

* Make Sure given execute permission

```
chmod +x /usr/bin/composer
```

* Create new laravel project using create-project option  through composer

```
composer create-project laravel/laravel laravel --no-dev
```

* Once entered into laravel project folder install **laravel/ui** package.

```
cd laravel
composer require laravel/ui --auth --update-no-dev
```

* execute laravel/ui with authentication to generate authentication and related files.

```
php artisan ui bootstrap --auth
```

* Execute migration to create database tables related to laravel skeleton app.

```
php artisan migrate
```

* Run Database Seeder if there any
```
php artisan db:seed
```

* Generate bootstrap/vue based css/js file should be generated through **npm install** and **npm run** command.

```
npm install
npm run prod
```

* Apart from these jumbotron layout are included here with slight modification on css

```
.jumbotron { background-color - Removed. Padding reduced to 1em}
. fixed-bottom .fixed-top { Added margin-bottom to 1rem}
```