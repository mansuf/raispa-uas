FROM ubuntu:latest

WORKDIR /app

COPY . /app

# Copy apache2 website config
COPY ./raispa.apache.conf /etc/apache2/sites-available

RUN apt-get update
RUN apt-get install apache2 -y


