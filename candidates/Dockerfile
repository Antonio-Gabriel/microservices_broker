FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip

# FROM nginx:alpine
# ADD nginx/default.conf /etc/nginx/conf.d

WORKDIR /www