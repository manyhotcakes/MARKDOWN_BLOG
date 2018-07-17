#

## Introduction

## For Developpers

This project is using Laravel v5.6.
https://laravel.com/docs/5.6/installation

if this app will work on your pc, you have to make sure following requirements:

- php >= 7.1.3
- composer >= 1.6.5
- node >= v8.11.3
- Docker
- DockerCompose

### Commands

```
git clone https://github.com/manyhotcakes/MARKDOWN_BLOG.git
cd MARKDOWN_BLOG
composer install
cp .env.example .env
php artisan key:generate
cd docker
docker-compose up -d
```
