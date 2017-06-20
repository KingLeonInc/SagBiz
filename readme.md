<p align="center"><img src="http://legatum-group.com/sag/public/images/logo2.png"></p>

<p align="center">

</p>

## About SAG BIZ - A Laravel Event and Tradeshow App

The code that powers [SAG Biz](http://legatum-group.com/sag/public) 
This is an event/tradeshow laravel application which consists of the following features

- Create/Update Events and Tradeshows
- Event/Tradeshow Registration
- Email Notification
- Event/Tradeshows Gallery
- Photo/Video ads 

## Installation Steps

After cloning the repository, first create a .env from the example file:

```
cp .env.example .env
```

Open ".env" file with your desired editor and enter your services info.
Now run below commands:

```
composer install
php artisan key:generate
php artisan migrate
```

Once the database files are migrated it's time to create an admin:

```
> php artisan tinker
>>> factory(App\User::class)->create([
        'name' => "YOUR_NAME",
        'email' => "YOUR_EMAIL@EXAMPLE.COM",
        'password' => bcrypt("YOUR_PASSWORD")
    ]);
```
Cheers, there you go. You've finished your installation. Enjoy the app.
Use the above credentials(email and password) to login to your system.
