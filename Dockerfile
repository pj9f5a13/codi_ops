FROM php:8.3-apache
WORKDIR /var/www/html
COPY codi .
EXPOSE 80
