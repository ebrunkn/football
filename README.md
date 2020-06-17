# Football Team Management Application
Laravel Development
This is a basic application to manage football team and its players.
### Tech
* PHP 7.2.5
* MySQL - Database
* Laravel 7.x - PHP MVC framework.
* HTML 5
* Bootstrap 4 - CSS framework for responsive UI
* jQuery
* Ajax
### Installation
Pull the code from repo [Repo](https://github.com/ebrunkn/football.git) to your local directory.
Create a databse in your MySQL.
Create .env file on root folder from .env.example and update it with below parameters:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

ADMIN_THEME=admin
```

Run Below commands on terminal:
```sh
$ cd {root folder}
$ composer install
$ php artisan key:generate
$ php artisan config:cache
```

### Database setup
Create a DB Schema with fresh sample data
```sh
$ php artisan migrate:fresh --seed
```
OR:
Create a DB Schema with only admin data
```sh
$ php artisan migrate:fresh
$ php artisan db:seed --class=AdminTableSeeder
```
### Passport installation (For API calls)
Run below commands on terminal.
```sh
$ php artisan passport:install
```

### Run the application
Run below commands on terminal.
```sh
$ php artisan serve
```
Open the application on browser by accessing: 
```sh
http://localhost:8000/
```
#### Admin credentails: 
```sh
Username: demo@admin.com
Password: password
```
### Plugins

Application is currently developed with the following plugins. Instructions on how to use them in your own application are linked below.

#### Back-end

| Plugin | URL |
| ------ | ------ |
| laravelcollective/html | https://laravelcollective.com/docs/6.0/html |
| maatwebsite/excel | https://laravel-excel.com/ |
| laravel/passport | https://laravel.com/docs/7.x/passport#introduction |

#### Front-end

| Plugin | URL |
| ------ | ------ |
| Bootstrap 4 | https://getbootstrap.com/ |
| MD Icons | https://cdn.materialdesignicons.com/1.1.34/ |
