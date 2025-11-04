# استفاده از image آماده که شامل همه چیز است
FROM webdevops/php-nginx:8.2

# تنظیم دایرکتوری کاری
WORKDIR /app

# کپی فایل‌ها
COPY . /app

# تنظیم مجوزها
RUN chown -R application:application /app && \
    if [ -d /app/storage ]; then chmod -R 775 /app/storage; fi && \
    if [ -d /app/bootstrap/cache ]; then chmod -R 775 /app/bootstrap/cache; fi

# نصب وابستگی‌ها (اگر composer.json وجود داشت)
RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader; fi

EXPOSE 80

CMD ["supervisord"]
