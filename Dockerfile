FROM php:8-cli
RUN apt-get update \
    && apt-get install -y git zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
ADD ./ .
RUN php /usr/local/bin/composer install
RUN ln -s /app/app /usr/local/bin/app

CMD ["php", "-a"]
