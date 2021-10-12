FROM php:7.4-fpm

ARG DOCKER_RUN_USER_ID
ARG DOCKER_RUN_USER_NAME
ARG DOCKER_RUN_GROUP_ID
ARG DOCKER_RUN_GROUP_NAME

ENV DOCKER_RUN_USER_ID=$DOCKER_RUN_USER_ID
ENV DOCKER_RUN_USER_NAME=$DOCKER_RUN_USER_NAME
ENV DOCKER_RUN_GROUP_ID=$DOCKER_RUN_GROUP_ID
ENV DOCKER_RUN_GROUP_NAME=$DOCKER_RUN_GROUP_NAME

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN mkdir -p /usr/share/man/man1

RUN apt update && \
    apt install -y \
        git \
        unzip \
        wget \
        libxml2-dev \
        pkg-config \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libzip-dev \
        libcurl4  \
        libonig-dev \
        sudo \
        build-essential

RUN docker-php-ext-install \
    xml \
    gd \
    zip \
    intl \
    mbstring \
    pdo_mysql

RUN sed -i 's/root.*/root   ALL=(ALL:ALL) NOPASSWD:ALL/' /etc/sudoers
RUN sed -i 's/%sudo.*/%sudo   ALL=(ALL:ALL) NOPASSWD:ALL/' /etc/sudoers
COPY user-mapping.sh /tools/user-mapping.sh
RUN chmod +x /tools/user-mapping.sh
RUN /tools/user-mapping.sh

 #xdebug
RUN pecl install xdebug-3.0.2 \
    && docker-php-ext-enable xdebug\
    && wget -O /usr/local/bin/xdebug https://raw.githubusercontent.com/julienfalque/xdebug/v2.0.0/xdebug \
    && chmod +x /usr/local/bin/xdebug

COPY php.ini /usr/local/etc/php/php.ini
COPY php-cli.ini /usr/local/etc/php/php-cli.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY boot.sh /tools/boot.sh
RUN chmod +x /tools/boot.sh

CMD ["/tools/boot.sh"]
