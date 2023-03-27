FROM php:8.1-cli-alpine

#RUN apk add --no-cache \
RUN apk add \
        $PHPIZE_DEPS \
        && pecl install swoole \
        && docker-php-ext-enable swoole

WORKDIR /app

CMD ["php", "src/index.php"]