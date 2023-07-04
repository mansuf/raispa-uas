FROM php:8.2-apache

WORKDIR /app
COPY . /app

# Copy apache2 website config
COPY ./raispa.apache.conf /etc/apache2/sites-available

RUN a2ensite raispa.apache.conf
RUN a2dissite 000-default.conf
RUN apachectl configtest

EXPOSE 80