<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Project Setup

```sh
docker compose up -d
```

If there any permission issue please run with sudo privilege 

```sh
sudo docker compose up -d
```

Add your .env setup Foe example Database 

```sh
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=excel_data_uploader
DB_USERNAME=excel_data_uploader
DB_PASSWORD=excel_data_uploader24
DB_ROOT_PASSWORD=excel_data_uploader24

```

For Queue Connection 

```sh

QUEUE_CONNECTION=redis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

```

To Run Php unit test got to php docker terminal run

```sh

php artisan test

```

Worker automatically run queue when up docker

I have added open api docs for api documentation 