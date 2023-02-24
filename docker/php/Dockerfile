FROM php:7.2-fpm

## docker-php-ext-install mcrypt libmcrypt-dev
RUN apt-get update && apt-get install -y software-properties-common
RUN add-apt-repository "deb http://ftp.us.debian.org/debian/ stretch main contrib non-free"
RUN add-apt-repository "deb http://ftp.us.debian.org/debian/ stretch-updates main contrib non-free"
RUN add-apt-repository "deb http://security.debian.org/ stretch/updates main contrib non-free"
RUN add-apt-repository "deb http://ftp.debian.org/debian stretch-backports main"
RUN apt-get update && apt-get install -y nano libssl1.0-dev git wget xz-utils\
    mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install pdo_mysql mbstring bcmath \
    && wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.3/wkhtmltox-0.12.3_linux-generic-amd64.tar.xz \
    && tar vxf wkhtmltox-0.12.3_linux-generic-amd64.tar.xz && cp wkhtmltox/bin/wk* /usr/local/bin/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/pined

# Use the default production configuration
RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

# Override with custom opcache settings
#COPY custom.ini $PHP_INI_DIR/conf.d/
#RUN kill -USR2 1
#RUN composer install
#CMD ["mv", ".env.example", ".env"] 
#RUN chmod 777 bootstrap/  public/ storage/
