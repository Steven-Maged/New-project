# الخطوة 1: استخدام صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# الخطوة 2: تثبيت الإضافات المطلوبة لـ Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# الخطوة 3: تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# الخطوة 4: إعداد العمل في المجلد الرئيسي
WORKDIR /var/www/html

# الخطوة 5: نسخ الملفات إلى داخل الحاوية
COPY . .

# الخطوة 6: تثبيت الحزم باستخدام Composer
RUN composer install --no-dev --optimize-autoloader

# الخطوة 7: إعطاء الصلاحيات لمجلد التخزين
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# الخطوة 8: تعيين المداخل الافتراضية
EXPOSE 80

# الخطوة 9: تشغيل Apache
CMD ["apache2-foreground"]
