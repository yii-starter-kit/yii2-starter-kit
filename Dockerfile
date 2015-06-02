FROM php:5.6-cli

RUN apt-get update && \
        DEBIAN_FRONTEND=noninteractive apt-get -y install \
                git \
                curl \
                openssl \
                libfreetype6-dev \
                libjpeg62-turbo-dev \
                libmcrypt-dev \
                libpng12-dev \
                libicu-dev \
                        --no-install-recommends \
        && docker-php-ext-install zip mcrypt intl mbstring pdo_mysql \
        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
        && docker-php-ext-install gd


# Install modules
RUN apt-get update && apt-get install -y

RUN apt-get autoremove -y \
        && rm -r /var/lib/apt/lists/*

# Install composer && global asset plugin
ENV COMPOSER_HOME /root/.composer
ENV PATH /root/.composer/vendor/bin:$PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    /usr/local/bin/composer global require "fxp/composer-asset-plugin"