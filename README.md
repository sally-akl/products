laravel 7

1- go to project directory in command line (cmd)
2-type (composer install) in command line  

3-change
DB_DATABASE=products
DB_USERNAME=root
DB_PASSWORD=
in .env file with your database

4- type  (php artisan migrate) in command line  

4- type  (php artisan db:seed) in command line  

5- type   (composer require laravel/ui:^2.4) in command line   (if auth not work)

6 type   (php artisan serve) in command line  

7- in your browser type (http://127.0.0.1:8000/dashboard) or url appear after type (php artisan serve) in command line   in step 6

8- login with
email :- admin@admin.com
password :- 123456
