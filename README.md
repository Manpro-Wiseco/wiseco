<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/main/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About

Wiseco Dashboard and Advisory Business

## Installation

Before the installation you must download [Node.js](https://nodejs.org/en/download/), [Composer](https://getcomposer.org/Composer-Setup.exe), and [XAMPP](https://www.apachefriends.org/xampp-files/7.4.27/xampp-windows-x64-7.4.27-2-VC15-installer.exe) with PHP 7.4.x or [Laragon](https://github.com/leokhoa/laragon/releases/download/5.0.0/laragon-wamp.exe) with PHP 7.4.x

1. Git clone

```shell
git clone https://github.com/Manpro-Wiseco/wiseco.git
```

or if you have clone it you should just fetch with

```shell
git checkout main
git pull origin main
```

and you can jump to step 4

2. Composer install

```shell
composer install
```

3. Make .env files from .env.example and configuration .env file with your configuration

4. Run this command

```shell
php artisan key:generate
```

5. Make migrations and seeds

```shell
php artisan migrate:fresh --seed
```

6. Install & compile node modules

```shell
npm install && npm run dev
```

7. Run this project in the browser

```shell
http://localhost/wiseco/public/
```

or
Run through the console with this command

```shell
php artisan serve
```

then access it in browser

```shell
http://localhost:8000/
```

8. **IMPORTANT!** If you want to make changes to the code, create a new branch for example : fitur-pembelian

```shell
git checkout fitur-pembelian
```

9. Make changes to the code

10. Commit your changes

```shell
git add .
git commit -m "your-message"
git push origin fitur-pembelian
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
