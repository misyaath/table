FROM php:8.1-fpm-alpine as php-base

LABEL Description="ExcelDataUploader base PHP image fork of php:8.1-fpm"
LABEL Vendor="ExcelDataUploader"
LABEL Version=1.0

# --------- Install dependancies
RUN apk add --update --no-cache \
        bash \
        curl \
        shadow \
        icu-libs \
        libintl \
        libzip \
        aria2 \
        gettext \
        patch

# --------- Install build dependancies
RUN apk add --update --no-cache --virtual .docker-php-global-dependancies \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        gettext-dev \
        gmp-dev \
        icu-dev \
        oniguruma-dev \
        libxml2-dev \
        ldb-dev \
        libzip-dev \
        autoconf \
        g++ \
        make \
        pcre-dev \
        wget

# --------- Install php extensions
RUN php -m && \
    docker-php-ext-configure bcmath --enable-bcmath && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-configure gettext && \
    docker-php-ext-configure gmp && \
    docker-php-ext-configure intl --enable-intl && \
    docker-php-ext-configure mbstring --enable-mbstring && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-configure pcntl --enable-pcntl && \
    docker-php-ext-configure soap && \
    docker-php-ext-configure zip && \
    docker-php-ext-install bcmath \
        gd \
        gettext \
        gmp \
        intl \
        mbstring \
        opcache \
        pcntl \
        soap \
        dom \
        xml \
        zip && \
    php -m

RUN apk add libpng-dev
RUN docker-php-ext-install gd
RUN apk add librdkafka-dev

# ENABLE CURL
RUN apk add --update curl-dev && \
    docker-php-ext-install curl && \
    apk del gcc g++ && \
    php -m;

# Enable MCRYPT
RUN apk add --update libmcrypt-dev && \
      pecl install mcrypt && \
      docker-php-ext-enable mcrypt && \
      php -m;


# Enable MySQL
RUN apk add --update --no-cache --virtual .docker-php-mysql-dependancies \
              mysql-client && \
          docker-php-ext-configure mysqli && \
          docker-php-ext-configure pdo_mysql && \
          docker-php-ext-install mysqli \
          pdo_mysql && \
          apk del .docker-php-mysql-dependancies && \
          php -m;

# Enable Redis
RUN pecl install redis && \
          docker-php-ext-enable redis && \
          php -m;

# Enable composer
RUN php -r "readfile('https://getcomposer.org/installer');" |  \
    php -- --install-dir=/usr/bin/ --filename=composer


# Enable Xdebug
ARG INSTALL_PHP_XDEBUG
RUN if [ $INSTALL_PHP_XDEBUG = true ]; then \
        apk add --update linux-headers \
        && pecl install xdebug \
        && docker-php-ext-enable xdebug \
    ;fi

# Big clean
RUN apk del .docker-php-global-dependancies && \
    rm -rf /var/cache/apk/* && \
    docker-php-source delete


#-----------------------------  Layer 2 - PHP backend build  -----------------------------
FROM php-base as php-backend


# --------- Setup build options
ARG EXCEL_DATA_UPLOADER_WORK_DIR='/var/www'

# --------- Copy application files inside the image
COPY ./ /var/www/
COPY ./docker/php/custom-entrypoint.sh /usr/local/bin/custom-entrypoint.sh
COPY ./docker/php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php/php/custom.ini.template /usr/local/etc/php/conf.d/custom.ini.template
COPY ./docker/php/php/php-cli.ini /usr/local/etc/php/php-cli.ini
COPY ./docker/php/php/healthcheck.ini /usr/local/etc/php/healthcheck.ini
COPY ./docker/php/startup.sh /usr/local/bin/startup.sh

# Change Working directory
WORKDIR $EXCEL_DATA_UPLOADER_WORK_DIR

RUN composer install --no-dev

RUN php artisan vendor:publish --tag=public

RUN chown -R root:root $EXCEL_DATA_UPLOADER_WORK_DIR

RUN rm -Rf /var/www/docker /root/.composer/

#-----------------------------  Layer 3 - NPM build  -----------------------------

RUN apk add --update nodejs npm

RUN node -v

RUN npm -v

RUN npm install

RUN npm run build

#-----------------------------  Layer 3 - NPM build  -----------------------------


#-----------------------------  Layer 4 - Final build: PHP + NPM  -----------------------------

# Setup build options
ARG EXCEL_DATA_UPLOADER_WORK_DIR='/var/www/'

LABEL Description="ExcelDataUploader base PHP image fork of php:8.1-fpm-alpine"
LABEL Vendor="ExcelDataUploader"
LABEL Version=1.0


# User and ownership
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data \
    && mkdir -p /home/www-data/.composer/cache \
    && mkdir -p /var/log/php \
    && mkdir -p /var/log/crond \
    && mkdir -p /var/log/supervisord \
    && touch /var/log/php/php_error.log \
    && touch /var/log/php/php-fpm-access.log \
    && touch /var/log/php/php-fpm-error.log \
    && touch /var/log/php/php-cli-error.log \
    && find /var/log/php -type f -exec chmod 755 {} \; \
    && chown -R www-data:www-data /home/www-data /var/www \
    && chown -R www-data:www-data /var/log/php /var/log/crond /var/log/supervisord

RUN mkdir -p ${EXCEL_DATA_UPLOADER_WORK_DIR}/storage/framework/sessions && \
    mkdir -p ${EXCEL_DATA_UPLOADER_WORK_DIR}/storage/framework/views && \
    mkdir -p ${EXCEL_DATA_UPLOADER_WORK_DIR}/storage/framework/cache && \
    mkdir -p ${EXCEL_DATA_UPLOADER_WORK_DIR}/storage/key && \
    mkdir -p ${EXCEL_DATA_UPLOADER_WORK_DIR}/storage/logs && \
    chmod -R 777 ${EXCEL_DATA_UPLOADER_WORK_DIR}/storage && \
    chmod -R 777 ${EXCEL_DATA_UPLOADER_WORK_DIR}/bootstrap


# Expose port
EXPOSE 9000

# Command
CMD ["php-fpm"]
