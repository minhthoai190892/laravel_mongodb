<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel - MongoDB

## 1. Create Laravel 10 Project

> composer create-project laravel/laravel test-mongodb

## 2. Install MongoDB Package for Laravel

[Link Install the MongoDB Package for Laravel](https://www.mongodb.com/compatibility/mongodb-laravel-integration)

> composer require mongodb/laravel-mongodb

## 3. Update database.php file:-

-   In order for Laravel to communicate with your MongoDB database, update database connection information to the config\database.php file under the “connections” object.
    > 'mongodb' => [
            'driver' => 'mongodb',
            'dsn' => env('DB_URI', 'mongodb+srv://username:password@<atlas-cluster-uri>/myappdb?retryWrites=true&w=majority'),
            'database' => 'myappdb',
    ],

## 4. Update .env file:-

-   Now, update the .env file to connect with the MongoDB database. Update DB_CONNECTION as mongodb, DB_DATABASE as your database name like laravelmongo in our case and DB_URI as mongodb://localhost:27017

> DB_CONNECTION=mongodb
> DB_HOST=127.0.0.1
> DB_PORT=27017
> DB_DATABASE=laravelmongo
> DB_USERNAME=
> DB_PASSWORD=
> DB_URI=mongodb://localhost:27017

## 5. Run "php artisan migrate"

Run the "php artisan migrate" command to add default auth tables like users in laravelmongo database.

## 6. Test at MongoDB Compass:-

Finally, test at MongoDB Compass to check if all the default collections including the users collection added to the laravelmongo database.

-   Run below command
    > npm install
    > npm run dev

Alternative commands :-

> -   composer require laravel/ui --dev
> -   php artisan ui bootstrap --auth
>     or
> -   php artisan ui vue --auth

-   Update User.php:
    > Replace Authenticatable class at User model that we will fetch from MongoDB
    > Replace
    > use Illuminate\Foundation\Auth\User as Authenticatable;
    > With
    > use MongoDB\Laravel\Auth\User as Authenticatable;

## CRUD Operations

1. Create a Post Model with a Resource Controller
   Run below command:
    > php artisan make:model Post -mcr
2. Update the create\*posts_table migration file and add title, description, and status columns to it.
   \*\**(F1 =>create*posts_table)\*\*\*

    table: **Post**
    | title | string |
    |---|---|
    | description | text |
    |status| tinyInteger|

3. Run the "php artisan migrate" command to create a posts table
4. Create Route:-
   Route::resource('posts', 'App\Http\Controllers\PostController');
5. Update the "create" function at PostController **_(gọi trang create)_**
6. Create a posts folder at /resources/views/ and create a file create.blade.php **_(tạo trang create)_**

7)  Copy content from the register.blade.php file and make changes accordingly. Add title and description fields with the submit button.
8)  Update store function at PostController:- **_(lưu trữ dữ liệu)_**
9)  Update the Post model and connect mongodb

    > use MongoDB\Laravel\Eloquent\Model;

         //khai báo kết nối vói mongodb
         protected $connection = 'mongodb' ;
10) Update create.blade.php file :-
Show a success message after posting data.