## Mini-crm

- Mini-crm contains employees from companies.

- Make auth of laravel and make seeder of on user admin.
- Create CRUD of Companies in dashboard.
- Create CRUD of Employees in dashboard.
- Handle database records with repository pattern. 
- Use Admin lte as dashboard and free theme in frontend.

Installation
- First create database, copy .en.example and make new file .env
 then change 
 DB_DATABASE=name 0f database
 in .env file.
 run these following commands:
- composer install
- php artisan key:generate
- php artisan migrate --seed
- php artisan storage:link
- You can login with user name : admin@admin.com
and password : password in this link http://localhost/mini-crm/admin .
