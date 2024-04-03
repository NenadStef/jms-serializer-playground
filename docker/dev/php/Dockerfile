FROM public.ecr.aws/docker/library/php:8.3-cli-alpine3.19

ARG HOST_USER_ID

# SYS: Remove cache and tmp files
RUN rm -rf /var/cache/apk/* && \
    rm -rf /tmp/*

# SYS: Install required packages
RUN apk --no-cache upgrade && \
    apk --no-cache add \
      autoconf \
      bash \
      g++ \
      gcc \
      gettext \
      git \
      icu-dev \
      make \
      openssh \
      shadow \
      sudo && \
    apk add --update linux-headers

# USER: change user id if provided
RUN /bin/bash -c 'if [ -n $HOST_USER_ID ] && [ $HOST_USER_ID -lt 60000 ]; then \
        usermod -u ${HOST_USER_ID} www-data; \
    fi'

# USER: set /bin/bash and allow www-data to become root
RUN usermod -s /bin/bash www-data && \
    echo 'www-data ALL=(ALL) NOPASSWD: ALL' > '/etc/sudoers.d/www-data'

# USER: copy home
COPY --chown=www-data:www-data dev/php/files/user-home /home/www-data

# USER: add ssh key and fix permission of the ssh directory
RUN ln -s /run/secrets/ssh_host_key /home/www-data/.ssh/id_rsa && \
    chown -R www-data:www-data /home/www-data && \
    chmod 700 /home/www-data/.ssh && \
    chmod 400 /home/www-data/.ssh/config

# LOG && Permissions
RUN mkdir -p /var/log/php /var/log/nellestef && \
    chown -R www-data:www-data /var/log/* && \
    chmod g+w /var/log/php /var/log/nellestef && \
    chmod 777 /tmp

# PHP: Copy configuration files
COPY dev/php/files/php/ /phpIni
COPY dev/php/files/bin/ /usr/local/bin/

# PHP: Install php extensions
RUN pecl channel-update pecl.php.net && \
    pecl install xdebug && \
    docker-php-ext-install pcntl && \
    php-ext-enable jobcloud && \
    php-ext-disable xdebug

# COMPOSER: install binary
COPY --from=composer /usr/bin/composer /usr/bin/composer

USER www-data

WORKDIR /var/www/html
