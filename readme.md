# MarkdownBlog

## Introduction

The simple blog you can post with markdown.

## Requirements

This project is using Laravel v5.6.
https://laravel.com/docs/5.6/installation

if you want that this app work on your pc, you have to make sure following requirements:

- php >= 7.1.3
- composer >= 1.6.5
- node >= v8.11.3
- Docker
- DockerCompose

## Installation

```
git clone https://github.com/manyhotcakes/MARKDOWN_BLOG.git
cd MARKDOWN_BLOG
composer install
cp .env.example .env

# set laravel enviroment
php artisan key:generate
php artisan storage:link

# generate front codes
yum install
yum run prod

# set database
cd docker
docker-compose up -d
cd ../
php artisan migrate
php artisan db:seed
```
