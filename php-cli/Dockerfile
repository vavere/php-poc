FROM php:8-cli-buster

RUN apt-get update \
&& apt-get install -y librabbitmq-dev xmlsec1 \
&& docker-php-source extract \
&& mkdir /usr/src/php/ext/amqp \
&& curl -L https://github.com/php-amqp/php-amqp/archive/master.tar.gz | tar -xzC /usr/src/php/ext/amqp --strip-components=1 \
&& docker-php-ext-install amqp sockets mysqli pdo_mysql pcntl \
&& docker-php-source delete \
&& pecl install -o ds \
&& echo "extension=ds.so" > /usr/local/etc/php/conf.d/ds.ini \
&& rm -rf /var/lib/apt/lists/*




