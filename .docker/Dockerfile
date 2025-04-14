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

# Instala Node.js e npm
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@6.14.15 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos da aplicação
COPY . .

# Define o diretório de trabalho para o Laravel
WORKDIR /var/www/laravel

# Verifica se .env existe; se não, copia .env.example para .env
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Instala dependências do Composer e do npm
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN npm install --no-deprecation

WORKDIR /var/www

# Define permissões corretas para o diretório de cache e logs
RUN chown -R www-data:www-data /var/www

# Expõe a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]