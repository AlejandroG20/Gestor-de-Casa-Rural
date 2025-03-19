@echo off

:: Instalar dependencias de Composer
composer install

:: Copiar el archivo .env
copy .env.example .env

:: Generar la clave de la aplicación
php artisan key:generate

:: Ejecutar las migraciones
php artisan migrate

:: Llenar la base de datos con datos de ejemplo
php artisan db:seed

:: Iniciar el servidor de Laravel en segundo plano
start /B php artisan serve

:: Esperar un momento para que el servidor arranque
timeout /t 3 /nobreak >nul

:: Abrir el navegador en localhost
start http://127.0.0.1:8000
