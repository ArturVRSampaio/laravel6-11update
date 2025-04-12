FROM php:7.2-fpm

# Instala extensões do PHP e dependências do sistema, incluindo ICU
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip intl \
    && docker-php-ext-enable pdo_mysql intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos da aplicação
COPY . .

# Define permissões corretas para o diretório de cache e logs
RUN chown -R www-data:www-data /var/www

# Expõe a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]