# 1. تحديد نسخة PHP والسيرفر
FROM php:8.2-apache

# 2. تثبيت المكتبات اللازمة للنظام
RUN apt-get update -y && apt-get install -y openssl zip unzip git libpq-dev

# 3. تثبيت إضافات قواعد البيانات لـ Laravel
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# 4. تثبيت أداة Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 5. نسخ ملفات مشروعك إلى السيرفر
COPY . /var/www/html
WORKDIR /var/www/html

# 6. تثبيت مكاتب Laravel (بدون مكاتب التطوير)
RUN composer install --no-dev --optimize-autoloader

# 7. إعطاء الصلاحيات اللازمة لـ Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. توجيه السيرفر ليقرأ من مجلد public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 9. تفعيل الروابط النظيفة في Laravel
RUN a2enmod rewrite
