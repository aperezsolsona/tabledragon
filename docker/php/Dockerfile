FROM php:8.3-fpm-alpine

ARG APP_ROOT

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# PHP Extensions
RUN apk add bash
RUN install-php-extensions intl igbinary gettext exif redis zip pcntl posix gd @composer uuid pcov pdo pdo_pgsql

# PHP INI
# COPY docker/php/php.ini /usr/local/etc/php/php.ini

# XDEBUG
#RUN install-php-extensions xdebug-3.3.1
#COPY docker/php/php-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./ ${APP_ROOT}/

WORKDIR ${APP_ROOT}