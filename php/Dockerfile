FROM php:8-fpm-buster

RUN docker-php-ext-install mysqli

RUN docker-php-source extract \
&& apt-get update \
&& apt-get install -y git librabbitmq-dev \
&& git clone --recurse-submodules --branch master --depth 1 https://github.com/php-amqp/php-amqp.git /usr/src/php/ext/amqp \
&& cd /usr/src/php/ext/amqp \
&& docker-php-ext-install amqp sockets \
&& rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
