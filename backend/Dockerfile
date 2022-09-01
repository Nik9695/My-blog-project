FROM docker.io/bitnami/laravel:9 AS builder

WORKDIR /app

COPY . .

RUN composer install --ignore-platform-reqs
