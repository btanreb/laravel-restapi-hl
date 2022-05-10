FROM php:8.0-apache

RUN apt-get update \
    && apt-get -y install \
        unzip \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libicu-dev \
        libmagickwand-dev \
        git \
        wget \
        iproute2 \
        iputils-ping \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#        gnupg2 && \
#    apt-key update && \
#    apt-get update && \
#    apt-get -y install \
#            default-mysql-client \
#        --no-install-recommends && \
#        apt-get clean && \
#        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install \
        exif \
        pdo_mysql \
        gd \
        intl


# Install PECL extensions
# see http://stackoverflow.com/a/8154466/291573) for usage of `printf`
# RUN printf "\n" | pecl install \
#         xdebug && \
#     docker-php-ext-enable \
#         xdebug

# Environment settings
ENV PHP_USER_ID=33 \
    # PHP_ENABLE_XDEBUG=1 \
    PATH=/project:/root/.composer/vendor/bin:$PATH \
    TERM=linux \
#    VERSION_PRESTISSIMO_PLUGIN=^0.3.7 \
    COMPOSER_ALLOW_SUPERUSER=1

# Add configuration files
COPY image-files/ /
RUN echo umask 002 >> /etc/bash.bashrc


# Enable mod_rewrite for images with apache
RUN if command -v a2enmod >/dev/null 2>&1; then \
        a2enmod rewrite headers \
    ;fi

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer.phar \
        --install-dir=/usr/local/bin && \
    composer.phar clear-cache

#RUN composer global require laravel/installer

#RUN wget https://get.symfony.com/cli/installer -O - | bash && \
#        mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /project

# composer create-project --prefer-dist laravel/laravel ./
