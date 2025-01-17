FROM php:8.2.11-fpm-bullseye as app_base
ENV DEBIAN_FRONTEND="noninteractive"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd gmp pdo_mysql zip imagick bcmath pcntl exif;

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer;

RUN apt-get update; \
    apt-get install -y software-properties-common curl wget sudo tar nginx; \
    apt-get update --fix-missing;

RUN mkdir -p /run/php; \
    mkdir -p /root/.cache; \
    mkdir -p /var/www/project;

FROM app_base as app_base_dev
RUN install-php-extensions xdebug
