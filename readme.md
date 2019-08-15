# Laravel 5.8 blog


Figured test

## Installation

Development environment requirements :
- [Docker](https://www.docker.com) >= 17.06 CE
- [Docker Compose](https://docs.docker.com/compose/install/)

Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/guillaumebriday/laravel-blog.git
$ cd laravel-blog
$ cp .env.example .env
$ docker-compose run --rm --no-deps blog-server composer install
$ docker-compose run --rm --no-deps blog-server php artisan key:generate
$ docker-compose run --rm --no-deps blog-server php artisan storage:link
$ docker run --rm -it -v $(pwd):/app -w /app node yarn
$ docker-compose up -d
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).

## Before starting
You need to run the migrations with the seeds :
```bash
$ docker-compose run --rm blog-server php artisan migrate --seed
```

This will create a new user that you can use to sign in :
```yml
email: csulbaran@test.com
password: 123456
```

And then, compile the assets :
```bash
$ docker run --rm -it -v $(pwd):/app -w /app node yarn dev
```

## Useful commands
Seeding the database :
```bash
$ docker-compose run --rm blog-server php artisan db:seed
```

Running tests :
```bash
$ docker-compose run --rm blog-server ./vendor/bin/phpunit --cache-result --order-by=defects --stop-on-defect
```

In development environnement, rebuild the database :
```bash
$ docker-compose run --rm blog-server php artisan migrate:fresh --seed
```