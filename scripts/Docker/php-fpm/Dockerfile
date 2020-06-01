FROM php:7.3-fpm-stretch
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd imagick imap mailparse mysqli opcache xdebug zip

ADD http://packages.couchbase.com/releases/couchbase-release/couchbase-release-1.0-6-amd64.deb .

RUN apt-get update \
    && apt-get install -y lsb-release software-properties-common gnupg2 zlib1g-dev \
    && dpkg -i couchbase-release-1.0-6-amd64.deb \
    && rm couchbase-release-1.0-6-amd64.deb \
    && apt-get update \
    && apt-get install -y libcouchbase-dev libcouchbase2-bin build-essential

RUN pecl install couchbase

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Install Node.js/npm
RUN curl -sL https://deb.nodesource.com/setup_10.x -o nodesource_setup.sh \
    && bash nodesource_setup.sh \
    && rm nodesource_setup.sh \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Copy configuration files
COPY ./config/php.ini /usr/local/etc/php/php.ini

# Copy OR Bind Mount Source Files
#COPY ./application/ /var/www/html/
# Ensure proper permissions on working directory
#RUN chown www-data:www-data . -R
