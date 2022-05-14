FROM composer:2.3.5 as vendor

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php:8.1-cli-buster

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get -y update \
    && apt-get -y --no-install-recommends install \
        zlib1g-dev \
        libmemcached-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && rm /var/log/dpkg.log

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /app

COPY . /app
COPY --from=vendor /app/vendor /app/vendor

ENTRYPOINT ["entrypoint.sh"]
