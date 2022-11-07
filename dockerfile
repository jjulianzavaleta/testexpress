FROM php:7.3-apache

EXPOSE 80

RUN apt-get update && apt-get install gnupg  -y \ 
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/11/prod.list\
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen  -y\
    && locale-gen \
    && apt-get -y --no-install-recommends install \
        unixodbc-dev -y
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 \
    # && ACCEPT_EULA=Y apt-get install -y mssql-tools \ ## Para bcp and sqlcmd
    # && echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc \
    # && su && source ~/.bashrc \
    && apt-get install -y unixodbc-dev \
    && apt-get install -y libgssapi-krb5-2 
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-install mbstring pdo pdo_mysql mysqli\
    && pecl install sqlsrv pdo_sqlsrv xdebug  \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug